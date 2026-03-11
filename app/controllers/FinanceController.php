<?php
require_once __DIR__ . '/../models/FinancialCategory.php';
require_once __DIR__ . '/../models/FinancialTransaction.php';

class FinanceController extends Controller {

    public function __construct() {
        Auth::requireLogin();
    }

    // --- Dashboard Financeiro ---
    public function index() {
        $db = Database::getConnection();
        $today = date('Y-m-d');
        $firstDayOfMonth = date('Y-m-01');
        $lastDayOfMonth = date('Y-m-t');

        // Receitas do Mês (Pagas)
        $stmt = $db->prepare("SELECT SUM(amount) as total FROM financial_transactions WHERE type = 'income' AND status = 'paid' AND payment_date BETWEEN :start AND :end");
        $stmt->execute(['start' => $firstDayOfMonth, 'end' => $lastDayOfMonth]);
        $incomeMonth = $stmt->fetch()['total'] ?? 0.00;

        // Despesas do Mês (Pagas)
        $stmt = $db->prepare("SELECT SUM(amount) as total FROM financial_transactions WHERE type = 'expense' AND status = 'paid' AND payment_date BETWEEN :start AND :end");
        $stmt->execute(['start' => $firstDayOfMonth, 'end' => $lastDayOfMonth]);
        $expenseMonth = $stmt->fetch()['total'] ?? 0.00;

        $balanceMonth = $incomeMonth - $expenseMonth;

        // Contas a Pagar (Pendentes, vencendo até o fim do mês ou atrasadas)
        $stmt = $db->prepare("SELECT SUM(amount) as total FROM financial_transactions WHERE type = 'expense' AND status = 'pending' AND due_date <= :end");
        $stmt->execute(['end' => $lastDayOfMonth]);
        $pendingExpenses = $stmt->fetch()['total'] ?? 0.00;

        // Contas a Receber (Pendentes)
        $stmt = $db->prepare("SELECT SUM(amount) as total FROM financial_transactions WHERE type = 'income' AND status = 'pending' AND due_date <= :end");
        $stmt->execute(['end' => $lastDayOfMonth]);
        $pendingIncomes = $stmt->fetch()['total'] ?? 0.00;

        // Últimas 5 transações pendentes (para ação rápida)
        $stmt = $db->prepare("
            SELECT t.*, c.name as category_name 
            FROM financial_transactions t 
            JOIN financial_categories c ON t.category_id = c.id 
            WHERE t.status = 'pending' 
            ORDER BY t.due_date ASC LIMIT 5
        ");
        $stmt->execute();
        $upcomingPending = $stmt->fetchAll();

        // Check and trigger recurrences
        $this->processRecurrences();

        $this->view('layouts/admin', [
            'title' => 'Dashboard Financeiro | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/finance/dashboard', compact('incomeMonth', 'expenseMonth', 'balanceMonth', 'pendingExpenses', 'pendingIncomes', 'upcomingPending'))
        ]);
    }

    // --- Transações (Listing, Create, Delete, Pay) ---
    public function transactions() {
        $db = Database::getConnection();
        
        $typeFilter = $_GET['type'] ?? ''; // 'income', 'expense'
        $statusFilter = $_GET['status'] ?? ''; // 'pending', 'paid'
        
        $sql = "SELECT t.*, c.name as category_name FROM financial_transactions t JOIN financial_categories c ON t.category_id = c.id WHERE 1=1";
        $params = [];

        if ($typeFilter) {
            $sql .= " AND t.type = :type";
            $params['type'] = $typeFilter;
        }
        if ($statusFilter) {
            $sql .= " AND t.status = :status";
            $params['status'] = $statusFilter;
        }

        $sql .= " ORDER BY CASE WHEN t.status = 'pending' THEN 0 ELSE 1 END, t.due_date ASC, t.created_at DESC";

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $transactions = $stmt->fetchAll();

        $catModel = new FinancialCategory();
        $categories = $catModel->all();

        $this->view('layouts/admin', [
            'title' => 'Transações Financeiras | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/finance/transactions', compact('transactions', 'categories', 'typeFilter', 'statusFilter'))
        ]);
    }

    public function storeTransaction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = Validator::sanitize($_POST);
            $model = new FinancialTransaction();
            $model->create([
                'category_id' => (int)$data['category_id'],
                'description' => $data['description'],
                'type' => $data['type'], // 'income' or 'expense'
                'amount' => floatval($data['amount']),
                'due_date' => $data['due_date'],
                'payment_date' => $data['status'] === 'paid' ? date('Y-m-d') : null,
                'status' => $data['status'],
                'is_recurring' => isset($data['is_recurring']) ? 1 : 0,
                'recurrence_period' => isset($data['is_recurring']) ? $data['recurrence_period'] : null
            ]);
            $this->redirect('/admin/finance/transactions');
        }
    }

    public function deleteTransaction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $model = new FinancialTransaction();
                $model->delete($id);
            }
            $this->redirect('/admin/finance/transactions');
        }
    }

    public function payTransaction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $model = new FinancialTransaction();
                $model->update($id, [
                    'status' => 'paid',
                    'payment_date' => date('Y-m-d')
                ]);
            }
            $this->redirect('/admin/finance/transactions');
        }
    }

    // --- Categorias (Listing, Create, Delete) ---
    public function categories() {
        $model = new FinancialCategory();
        $categories = $model->all();

        $this->view('layouts/admin', [
            'title' => 'Categorias Financeiras | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/finance/categories', compact('categories'))
        ]);
    }

    public function storeCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = Validator::sanitize($_POST);
            $model = new FinancialCategory();
            $model->create([
                'name' => $data['name'],
                'type' => $data['type']
            ]);
            $this->redirect('/admin/finance/categories');
        }
    }

    public function deleteCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $model = new FinancialCategory();
                $model->delete($id);
            }
            $this->redirect('/admin/finance/categories');
        }
    }

    // --- Lógica Interna (Recorrências) ---
    private function processRecurrences() {
        // This is a simple logic that checks if a recurring transaction from a previous period
        // has already been generated for the CURRENT month/period. 
        // In a real huge app this would be a CRON job. Here we execute on load for simplicity.
        
        $db = Database::getConnection();
        
        // Find recurring transactions
        $stmt = $db->query("SELECT * FROM financial_transactions WHERE is_recurring = 1");
        $recurrings = $stmt->fetchAll();

        foreach ($recurrings as $rec) {
            $today = new DateTime();
            $dueDate = new DateTime($rec['due_date']);
            
            // Check if due_date is in the past or this month.
            // If the transaction's due date is older than 1 month, we should generate the next one.
            if ($rec['recurrence_period'] === 'monthly') {
                $nextDueDate = clone $dueDate;
                $nextDueDate->modify('+1 month');
                
                // If the next due date is already passed or is this month (we can generate up to current month)
                if ($nextDueDate <= $today || $nextDueDate->format('Y-m') === $today->format('Y-m')) {
                    
                    // Check if this duplicated transaction already exists to avoid flood
                    $checkStmt = $db->prepare("SELECT id FROM financial_transactions WHERE reference_id = :ref_id AND category_id = :cat_id AND due_date = :due");
                    // We use reference_id to track the "parent" recurring transaction
                    $parentRef = $rec['reference_id'] ? $rec['reference_id'] : $rec['id']; 
                    
                    $checkStmt->execute([
                        'ref_id' => $parentRef, 
                        'cat_id' => $rec['category_id'],
                        'due' => $nextDueDate->format('Y-m-d')
                    ]);

                    if (!$checkStmt->fetch()) {
                        // Generate it
                        $model = new FinancialTransaction();
                        $model->create([
                            'category_id' => $rec['category_id'],
                            'description' => $rec['description'] . " (" . $nextDueDate->format('m/Y') . ")",
                            'type' => $rec['type'],
                            'amount' => $rec['amount'],
                            'due_date' => $nextDueDate->format('Y-m-d'),
                            'status' => 'pending',
                            'reference_id' => $parentRef,
                            'is_recurring' => 1,
                            'recurrence_period' => 'monthly'
                        ]);
                        
                        // Break recurrent chain on old to prevent infinite gen loop, 
                        // only the newest generated should carry is_recurring = 1 for the NEXT month check.
                        // Or we can just let reference_id handle it. Let's just turn off recursion on the old one.
                        $model->update($rec['id'], ['is_recurring' => 0]); 
                    }
                }
            }
        }
    }

    private function renderPartial($view, $data = []) {
        extract($data);
        ob_start();
        require __DIR__ . "/../views/{$view}.php";
        return ob_get_clean();
    }
}

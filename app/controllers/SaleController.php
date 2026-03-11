<?php
require_once __DIR__ . '/../models/Sale.php';
require_once __DIR__ . '/../models/SaleItem.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Service.php';
require_once __DIR__ . '/../models/Customer.php';
require_once __DIR__ . '/../models/Professional.php';
require_once __DIR__ . '/../models/StockMovement.php';
require_once __DIR__ . '/../models/Commission.php';
require_once __DIR__ . '/../models/FinancialTransaction.php';

class SaleController extends Controller {

    public function __construct() {
        Auth::requireLogin();
    }

    public function index() {
        $db = Database::getConnection();
        // Get sales with customer name
        $stmt = $db->query("
            SELECT s.*, c.name as customer_name 
            FROM sales s 
            LEFT JOIN customers c ON s.customer_id = c.id 
            ORDER BY s.created_at DESC
        ");
        $sales = $stmt->fetchAll();

        $this->view('layouts/admin', [
            'title' => 'Vendas & PDV | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/sales/index', compact('sales'))
        ]);
    }

    public function create() {
        $customerModel = new Customer();
        $productModel = new Product();
        $serviceModel = new Service();
        $profModel = new Professional();

        $customers = $customerModel->all();
        $products = $productModel->where('is_active', 1);
        $services = $serviceModel->where('is_active', 1);
        $professionals = $profModel->all();

        $this->view('layouts/admin', [
            'title' => 'Frente de Caixa (PDV) | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/sales/create', compact('customers', 'products', 'services', 'professionals'))
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Read JSON payload from AlpineJS
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            if (!$data || empty($data['items'])) {
                $this->json(['success' => false, 'message' => 'Nenhum item na venda.']);
                return;
            }

            $customerId = !empty($data['customer_id']) ? (int)$data['customer_id'] : null;
            $paymentMethod = $data['payment_method'];

            $db = Database::getConnection();
            $db->beginTransaction();

            try {
                $saleModel = new Sale();
                $saleItemModel = new SaleItem();
                $productModel = new Product();
                $serviceModel = new Service();
                $stockMovementModel = new StockMovement();
                $commissionModel = new Commission();
                $profModel = new Professional();

                // Build mapping for professionals to get commission% quickly
                $profs = $profModel->all();
                $profCommissions = [];
                foreach($profs as $p) {
                    $profCommissions[$p['id']] = $p['commission_percentage'];
                }

                $totalAmount = 0;

                // 1. Create Sale entry
                $saleModel->create([
                    'customer_id' => $customerId,
                    'total_amount' => 0, // will update later
                    'payment_method' => $paymentMethod
                ]);
                $saleId = $db->lastInsertId();

                // 2. Process Items
                foreach ($data['items'] as $item) {
                    $type = $item['type']; // 'product' or 'service'
                    $itemId = (int)$item['item_id'];
                    $quantity = (int)($item['quantity'] ?? 1);
                    $professionalId = !empty($item['professional_id']) ? (int)$item['professional_id'] : null;
                    
                    $unitPrice = 0;
                    $itemCommissionPercent = 0;

                    if ($type === 'product') {
                        $prod = $productModel->find($itemId);
                        if (!$prod) throw new Exception("Produto não encontrado.");
                        $unitPrice = (float)$prod['price'];
                        $itemCommissionPercent = (float)$prod['commission_percentage'];
                        
                        // Deduct Stock
                        $newStock = max(0, (int)$prod['stock_quantity'] - $quantity);
                        $productModel->update($itemId, ['stock_quantity' => $newStock]);

                        // Add Stock Movement
                        $stockMovementModel->create([
                            'product_id' => $itemId,
                            'type' => 'out',
                            'quantity' => $quantity,
                            'reason' => "Venda PDV #$saleId"
                        ]);
                    } elseif ($type === 'service') {
                        $srv = $serviceModel->find($itemId);
                        if (!$srv) throw new Exception("Serviço não encontrado.");
                        $unitPrice = (float)$srv['price'];
                        
                        // Service commission logic goes to the Professional's personal percentage usually.
                        if ($professionalId && isset($profCommissions[$professionalId])) {
                            $itemCommissionPercent = (float)$profCommissions[$professionalId];
                        }
                    }

                    $subtotal = $unitPrice * $quantity;
                    $totalAmount += $subtotal;

                    // Save SaleItem
                    $saleItemModel->create([
                        'sale_id' => $saleId,
                        'type' => $type,
                        'item_id' => $itemId,
                        'professional_id' => $professionalId,
                        'quantity' => $quantity,
                        'unit_price' => $unitPrice,
                        'subtotal' => $subtotal
                    ]);

                    // Generate Commission
                    if ($professionalId && $itemCommissionPercent > 0) {
                        $commissionAmount = $subtotal * ($itemCommissionPercent / 100);
                        // Using 'appointment_id' as NULL for POS sales in commissions table is fine because the schema allows it technically? 
                        // Wait, looking at schema: appointment_id is NOT NULL in commissions. We need to alter it or use a trick.
                        // Let's create a dummy appointment or adjust schema. 
                        // Actually, I should alter table to allow NULL appointment_id for product commissions.
                        $db->exec("ALTER TABLE commissions RENAME TO commissions_old");
                        $db->exec("
                            CREATE TABLE commissions (
                                id INTEGER PRIMARY KEY AUTOINCREMENT,
                                appointment_id INTEGER NULL,
                                professional_id INTEGER NOT NULL,
                                amount REAL NOT NULL,
                                sale_item_id INTEGER NULL,
                                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                                FOREIGN KEY(appointment_id) REFERENCES appointments(id),
                                FOREIGN KEY(professional_id) REFERENCES professionals(id),
                                FOREIGN KEY(sale_item_id) REFERENCES sale_items(id)
                            )
                        ");
                        $db->exec("INSERT INTO commissions (id, appointment_id, professional_id, amount, created_at) SELECT id, appointment_id, professional_id, amount, created_at FROM commissions_old");
                        $db->exec("DROP TABLE commissions_old");
                        
                        $stmt = $db->prepare("INSERT INTO commissions (appointment_id, professional_id, amount, sale_item_id) VALUES (NULL, ?, ?, ?)");
                        $stmt->execute([$professionalId, $commissionAmount, $db->lastInsertId()]);
                        $commissionId = $db->lastInsertId();

                        // FINANCEIRO: Lançar Conta a Pagar (Pendente) para a comissão
                        $profName = $profs[array_search($professionalId, array_column($profs, 'id'))]['name'] ?? 'Profissional';
                        $catStmt = $db->query("SELECT id FROM financial_categories WHERE name = 'Comissão Profissional'");
                        $catId = $catStmt->fetchColumn() ?: 4; // Fallback

                        // Lançar
                        $fTransactionModel = new FinancialTransaction();
                        $fTransactionModel->create([
                            'category_id' => $catId,
                            'description' => "Comissão PDV: {$profName} (Item #{$itemId})",
                            'type' => 'expense',
                            'amount' => $commissionAmount,
                            'due_date' => date('Y-m-d'), // Vence hoje
                            'payment_date' => null,
                            'status' => 'pending',
                            'reference_id' => $commissionId,
                            'reference_type' => 'commission'
                        ]);
                    }
                }

                // 3. Update total amount on Sale
                $saleModel->update($saleId, ['total_amount' => $totalAmount]);

                // 4. Register payment
                $stmt = $db->prepare("INSERT INTO payments (appointment_id, sale_id, amount, method) VALUES (NULL, ?, ?, ?)");
                $stmt->execute([$saleId, $totalAmount, $paymentMethod]);

                // 5. FINANCEIRO: Lançar Receita Principal (Venda Fechada e Quitada)
                $catStmt = $db->query("SELECT id FROM financial_categories WHERE name = 'Venda PDV'");
                $catId = $catStmt->fetchColumn() ?: 1; // Fallback to 1 if missing

                $fTransactionModel = new FinancialTransaction();
                $fTransactionModel->create([
                    'category_id' => $catId,
                    'description' => "Venda de Balcão (PDV) #{$saleId}",
                    'type' => 'income',
                    'amount' => $totalAmount,
                    'due_date' => date('Y-m-d'),
                    'payment_date' => date('Y-m-d'), // Assume quitado
                    'status' => 'paid',
                    'reference_id' => $saleId,
                    'reference_type' => 'sale'
                ]);

                $db->commit();
                $this->json(['success' => true, 'redirect' => '/admin/sales']);
                
            } catch (Exception $e) {
                $db->rollBack();
                $this->json(['success' => false, 'message' => $e->getMessage()]);
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

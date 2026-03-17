<?php

require_once __DIR__ . '/../models/Customer.php';

class CustomerController extends Controller {
    
    public function __construct() {
        Auth::requireLogin();
    }

    public function index() {
        $page = (int) ($_GET['page'] ?? 1);
        $limit = 10;
        $search = $_GET['search'] ?? null;
        
        $filters = [];
        if ($search) {
            $filters['name'] = "%{$search}%";
        }
        
        $customerModel = new Customer();
        $customers = $customerModel->paginate($page, $limit, $filters);
        $total = $customerModel->count($filters);
        $totalPages = ceil($total / $limit);
        
        // If AJAX request, return only the table partial
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            echo $this->renderPartial('admin/customers/index_table', compact('customers', 'page', 'totalPages', 'total'));
            exit;
        }

        $this->view('layouts/admin', [
            'title' => 'Clientes | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/customers/index', compact('customers', 'page', 'totalPages', 'total', 'search'))
        ]);
    }

    public function create() {
        $this->view('layouts/admin', [
            'title' => 'Novo Cliente | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/customers/form', ['customer' => null])
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = Validator::sanitize($_POST);
            $customerModel = new Customer();
            $customerModel->create([
                'name' => $data['name'] ?? '',
                'phone' => $data['phone'] ?? '',
                'email' => $data['email'] ?? '',
                'notes' => $data['notes'] ?? ''
            ]);
            $this->redirect('/admin/customers');
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/customers');

        $customerModel = new Customer();
        $customer = $customerModel->find($id);

        $this->view('layouts/admin', [
            'title' => 'Editar Cliente | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/customers/form', compact('customer'))
        ]);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $data = Validator::sanitize($_POST);
                $customerModel = new Customer();
                $customerModel->update($id, [
                    'name' => $data['name'] ?? '',
                    'phone' => $data['phone'] ?? '',
                    'email' => $data['email'] ?? '',
                    'notes' => $data['notes'] ?? ''
                ]);
            }
            $this->redirect('/admin/customers');
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $customerModel = new Customer();
                $customerModel->delete($id);
            }
            $this->redirect('/admin/customers');
        }
    }
    
    private function renderPartial($view, $data = []) {
        extract($data);
        ob_start();
        require __DIR__ . "/../views/{$view}.php";
        return ob_get_clean();
    }
}

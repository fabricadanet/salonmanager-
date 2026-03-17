<?php
require_once __DIR__ . '/../models/Product.php';

class ProductController extends Controller {
    
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
        
        $model = new Product();
        $items = $model->paginate($page, $limit, $filters);
        $total = $model->count($filters);
        $totalPages = ceil($total / $limit);
        
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            echo $this->renderPartial('admin/products/index_table', compact('items', 'page', 'totalPages', 'total'));
            exit;
        }

        $this->view('layouts/admin', [
            'title' => 'Produtos | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/products/index', compact('items', 'page', 'totalPages', 'total', 'search'))
        ]);
    }

    public function create() {
        $this->view('layouts/admin', [
            'title' => 'Novo Produto | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/products/form', ['item' => null])
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../../core/ImageHandler.php';
            $data = Validator::sanitize($_POST);
            
            $imagePath = ImageHandler::handle(
                $_FILES['image'] ?? null,
                $data['image_url'] ?? null
            );

            $model = new Product();
            $model->create([
                'name' => $data['name'] ?? '',
                'description' => $data['description'] ?? '',
                'price' => floatval($data['price'] ?? 0),
                'image' => $imagePath,
                'min_stock_level' => (int)($data['min_stock_level'] ?? 5),
                'commission_percentage' => floatval($data['commission_percentage'] ?? 0.0)
            ]);
            $this->redirect('/admin/products');
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/products');

        $model = new Product();
        $item = $model->find($id);

        $this->view('layouts/admin', [
            'title' => 'Editar Produto | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/products/form', compact('item'))
        ]);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                require_once __DIR__ . '/../../core/ImageHandler.php';
                $data = Validator::sanitize($_POST);
                $model = new Product();
                $existing = $model->find($id);

                $imagePath = ImageHandler::handle(
                    $_FILES['image'] ?? null,
                    $data['image_url'] ?? null,
                    $existing['image'] ?? ''
                );

                $model->update($id, [
                    'name' => $data['name'] ?? '',
                    'description' => $data['description'] ?? '',
                    'price' => floatval($data['price'] ?? 0),
                    'image' => $imagePath,
                    'min_stock_level' => (int)($data['min_stock_level'] ?? 5),
                    'commission_percentage' => floatval($data['commission_percentage'] ?? 0.0)
                ]);
            }
            $this->redirect('/admin/products');
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $model = new Product();
                $model->delete($id);
            }
            $this->redirect('/admin/products');
        }
    }
    
    private function renderPartial($view, $data = []) {
        extract($data);
        ob_start();
        require __DIR__ . "/../views/{$view}.php";
        return ob_get_clean();
    }
}

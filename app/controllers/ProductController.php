<?php
require_once __DIR__ . '/../models/Product.php';

class ProductController extends Controller {
    
    public function __construct() {
        Auth::requireLogin();
    }

    public function index() {
        $model = new Product();
        $items = $model->all();
        
        $this->view('layouts/admin', [
            'title' => 'Produtos | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/products/index', compact('items'))
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

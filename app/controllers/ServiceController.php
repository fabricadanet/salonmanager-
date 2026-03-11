<?php
require_once __DIR__ . '/../models/Service.php';

class ServiceController extends Controller {
    
    public function __construct() {
        Auth::requireLogin();
    }

    public function index() {
        $model = new Service();
        $items = $model->all();
        
        $this->view('layouts/admin', [
            'title' => 'Serviços | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/services/index', compact('items'))
        ]);
    }

    public function create() {
        $this->view('layouts/admin', [
            'title' => 'Novo Serviço | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/services/form', ['item' => null])
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = Validator::sanitize($_POST);
            $model = new Service();
            $model->create([
                'name' => $data['name'] ?? '',
                'description' => $data['description'] ?? '',
                'price' => floatval($data['price'] ?? 0),
                'duration' => intval($data['duration'] ?? 0)
            ]);
            $this->redirect('/admin/services');
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/services');

        $model = new Service();
        $item = $model->find($id);

        $this->view('layouts/admin', [
            'title' => 'Editar Serviço | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/services/form', compact('item'))
        ]);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $data = Validator::sanitize($_POST);
                $model = new Service();
                $model->update($id, [
                    'name' => $data['name'] ?? '',
                    'description' => $data['description'] ?? '',
                    'price' => floatval($data['price'] ?? 0),
                    'duration' => intval($data['duration'] ?? 0)
                ]);
            }
            $this->redirect('/admin/services');
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $model = new Service();
                $model->delete($id);
            }
            $this->redirect('/admin/services');
        }
    }
    
    private function renderPartial($view, $data = []) {
        extract($data);
        ob_start();
        require __DIR__ . "/../views/{$view}.php";
        return ob_get_clean();
    }
}

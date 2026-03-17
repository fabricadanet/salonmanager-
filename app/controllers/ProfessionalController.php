<?php
require_once __DIR__ . '/../models/Professional.php';

class ProfessionalController extends Controller {
    
    public function __construct() {
        Auth::requireLogin();
    }

    public function index() {
        $page = (int) ($_GET['page'] ?? 1);
        $limit = 10;
        $search = $_GET['search'] ?? null;
        
        $filters = ['search' => $search];
        
        $model = new Professional();
        $items = $model->paginateWithUser($page, $limit, $filters);
        $total = $model->countWithFilters($filters);
        $totalPages = ceil($total / $limit);
        
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            echo $this->renderPartial('admin/professionals/index_table', compact('items', 'page', 'totalPages', 'total'));
            exit;
        }

        $this->view('layouts/admin', [
            'title' => 'Profissionais | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/professionals/index', compact('items', 'page', 'totalPages', 'total', 'search'))
        ]);
    }

    public function create() {
        $this->view('layouts/admin', [
            'title' => 'Novo Profissional | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/professionals/form', ['item' => null])
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = Validator::sanitize($_POST);
            $model = new Professional();
            $model->create([
                'name' => $data['name'] ?? '',
                'specialty' => $data['specialty'] ?? '',
                'commission_percentage' => floatval($data['commission_percentage'] ?? 0)
            ]);
            $this->redirect('/admin/professionals');
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/professionals');

        $model = new Professional();
        $item = $model->find($id);

        $this->view('layouts/admin', [
            'title' => 'Editar Profissional | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/professionals/form', compact('item'))
        ]);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $data = Validator::sanitize($_POST);
                $model = new Professional();
                $model->update($id, [
                    'name' => $data['name'] ?? '',
                    'specialty' => $data['specialty'] ?? '',
                    'commission_percentage' => floatval($data['commission_percentage'] ?? 0)
                ]);
            }
            $this->redirect('/admin/professionals');
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $model = new Professional();
                $model->delete($id);
            }
            $this->redirect('/admin/professionals');
        }
    }
    
    private function renderPartial($view, $data = []) {
        extract($data);
        ob_start();
        require __DIR__ . "/../views/{$view}.php";
        return ob_get_clean();
    }
}

<?php

require_once __DIR__ . '/../models/User.php';

class UserController extends Controller {
    public function __construct() {
        // Apenas 'admin' geral deve gerenciar os usuários do sistema
        Auth::requireRole('admin');
    }

    public function index() {
        $page = (int) ($_GET['page'] ?? 1);
        $limit = 10;
        $search = $_GET['search'] ?? null;
        
        $filters = [];
        if ($search) {
            $filters['name'] = "%{$search}%";
        }
        
        $userModel = new User();
        $users = $userModel->paginate($page, $limit, $filters);
        $total = $userModel->count($filters);
        $totalPages = ceil($total / $limit);

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            echo $this->renderPartial('admin/users/index_table', compact('users', 'page', 'totalPages', 'total'));
            exit;
        }

        $this->view('layouts/admin', [
            'title' => 'Gestão de Acessos | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/users/index', compact('users', 'page', 'totalPages', 'total', 'search'))
        ]);
    }

    public function create() {
        $this->view('layouts/admin', [
            'title' => 'Novo Usuário | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/users/form')
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = Validator::sanitize($_POST);
            
            // Validações básicas (Em um app complexo teríamos validações pesadas como isUnique Email)
            if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
                 // error states
                 $this->redirect('/admin/users');
                 exit;
            }

            $userModel = new User();
            $userModel->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'role' => $data['role']
            ]);

            $this->redirect('/admin/users');
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $userModel = new User();
            $user = $userModel->find($id);

            if ($user) {
                // Remove password hash from array before rendering form to not bleed info
                unset($user['password']);

                $this->view('layouts/admin', [
                    'title' => 'Editar Usuário | SalonManager',
                    'showSidebar' => true,
                    'content' => $this->renderPartial('admin/users/form', compact('user'))
                ]);
            }
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = Validator::sanitize($_POST);
            $id = $data['id'] ?? null;
            
            if ($id) {
                // Impede que um Admin altere seu próprio papel para se 'rebaixar' e perder acesso à tela users e o painel acidentalmente.
                $me = Auth::user();
                if ($me['id'] == $id && $data['role'] != 'admin') {
                    // Erro: não pode remover direitos de si mesmo
                    $this->redirect('/admin/users');
                    exit;
                }

                $userModel = new User();
                
                $updateData = [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'role' => $data['role']
                ];

                // Só processa senha se tiver escrita algo. Do contrario, mantem a antiga
                if (!empty($data['password'])) {
                    $updateData['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                }

                $userModel->update($id, $updateData);
            }
            $this->redirect('/admin/users');
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            
            if ($id) {
                $me = Auth::user();
                // Impedir de apagar o próprio usuário logado
                if ($me['id'] == $id) {
                    // Die ou Redirect with alert - Simple redirect for now
                    $this->redirect('/admin/users');
                    exit;
                }

                $userModel = new User();
                $userModel->delete($id);
            }
            $this->redirect('/admin/users');
        }
    }
    
    private function renderPartial($view, $data = []) {
        extract($data);
        ob_start();
        require __DIR__ . "/../views/{$view}.php";
        return ob_get_clean();
    }
}

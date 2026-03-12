<?php

class AuthController extends Controller {
    public function index() {
        if (Auth::check()) {
            $this->redirect('/admin');
        }
        $this->view('auth/login', $this->getBranding());
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = Validator::sanitize($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (Auth::attempt($email, $password)) {
                $this->redirect('/admin');
            } else {
                $this->view('auth/login', array_merge($this->getBranding(), ['error' => 'Credenciais inválidas.']));
            }
        }
    }

    private function getBranding() {
        require_once __DIR__ . '/../models/WebsiteContent.php';
        $model = new WebsiteContent();
        $logo = $model->where('section', 'logo')[0] ?? null;
        $login = $model->where('section', 'admin_login')[0] ?? null;
        return [
            'logo' => $logo['image'] ?? null,
            'background' => $login['image'] ?? 'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&q=80&w=1920'
        ];
    }

    public function logout() {
        Auth::logout();
        $this->redirect('/login');
    }
}

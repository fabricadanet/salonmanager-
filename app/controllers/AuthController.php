<?php

class AuthController extends Controller {
    public function index() {
        if (Auth::check()) {
            $this->redirect('/admin');
        }
        $this->view('auth/login');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = Validator::sanitize($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (Auth::attempt($email, $password)) {
                $this->redirect('/admin');
            } else {
                $this->view('auth/login', ['error' => 'Credenciais inválidas.']);
            }
        }
    }

    public function logout() {
        Auth::logout();
        $this->redirect('/login');
    }
}

<?php

class Auth {
    public static function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function attempt($email, $password) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            self::startSession();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_name'] = $user['name'];
            return true;
        }
        return false;
    }

    public static function check() {
        self::startSession();
        return isset($_SESSION['user_id']);
    }

    public static function user() {
        self::startSession();
        if (isset($_SESSION['user_id'])) {
            return [
                'id' => $_SESSION['user_id'],
                'role' => $_SESSION['user_role'],
                'name' => $_SESSION['user_name']
            ];
        }
        return null;
    }

    public static function logout() {
        self::startSession();
        session_unset();
        session_destroy();
    }
    
    public static function requireLogin() {
        if (!self::check()) {
            header("Location: /login");
            exit;
        }
    }
    
    public static function requireRole($roles) {
        self::requireLogin();
        $user = self::user();
        if (!in_array($user['role'], (array)$roles)) {
            http_response_code(403);
            die("Forbidden. You don't have permission to access this resource.");
        }
    }
}

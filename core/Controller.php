<?php

class Controller {
    protected function view($view, $data = []) {
        extract($data);
        
        $viewFile = __DIR__ . "/../app/views/{$view}.php";
        
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            die("View {$view} not found.");
        }
    }

    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }
    
    protected function json($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}

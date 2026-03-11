<?php

class Router {
    protected $routes = [];

    public function get($uri, $controllerAction) {
        $this->routes['GET'][$uri] = $controllerAction;
    }

    public function post($uri, $controllerAction) {
        $this->routes['POST'][$uri] = $controllerAction;
    }

    public function dispatch($uri, $method) {
        // Strip query string
        $uri = strtok($uri, '?');
        
        if (array_key_exists($uri, $this->routes[$method] ?? [])) {
            $action = $this->routes[$method][$uri];
            
            if (is_callable($action)) {
                return call_user_func($action);
            }
            
            if (is_string($action) && strpos($action, '@') !== false) {
                list($controller, $methodName) = explode('@', $action);
                $controllerClass = $controller;
                
                if (file_exists(__DIR__ . "/../app/controllers/{$controllerClass}.php")) {
                    require_once __DIR__ . "/../app/controllers/{$controllerClass}.php";
                    $controllerInstance = new $controllerClass();
                    return $controllerInstance->$methodName();
                }
            }
        }
        
        // Handle 404
        http_response_code(404);
        echo "404 Not Found";
    }
}

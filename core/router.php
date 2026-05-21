<?php

namespace Core;

class Router
{
    private $routes = [];

    public function add($route, $controller, $middleware = null)
    {
        $route = trim($route, '/');

        $this->routes[$route] = [
            'controller' => $controller,
            'middleware' => $middleware
        ];
    }

    public function dispatch($uri)
    {
        $uri = parse_url($uri, PHP_URL_PATH);

        $basePath = '/PW2_Proyect';

        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        $uri = trim($uri, '/');

        foreach ($this->routes as $key => $route) {
            $routePattern = preg_replace('/:\w+/', '([^/]+)', $key);

            if (preg_match('#^' . $routePattern . '$#', $uri, $matches)) {

                $middleware = $route['middleware'] ?? null;

                if ($middleware && file_exists($middleware)) {
                    require $middleware;
                }

                if (!file_exists($route['controller'])) {
                    die("Controlador no encontrado: " . $route['controller']);
                }

                require $route['controller'];
                return;
            }
        }

        $this->abort(404, $uri);
    }

    public function abort($code = 404, $uri = '')
    {
        http_response_code($code);
        echo "Error $code: Page not found.";
        echo "<br>Ruta recibida: " . htmlspecialchars($uri);
        exit();
    }
}
<?php


namespace App\Core;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    function dispatch()
    {

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routes[$method])) {
            $this->abort();
        }

        foreach ($this->routes[$method] as $path => $callback) {
            $routeRegex = preg_replace(
                '/\{[a-zA-Z]+\}/',
                '([a-zA-Z0-9_-]+)',
                $path
            );

            $routeRegex = '#^' . $routeRegex . '$#';

            if(preg_match($routeRegex,$uri,$matches)){
                array_shift($matches);

                if(is_callable($callback)){
                    call_user_func_array($callback,$matches);
                    return;
                }

                if(is_array($callback)) {
                    [$controller , $methodName] = $callback;

                    $controllerInstance = new $controller();

                    call_user_func_array(
                        [$controllerInstance,$methodName],
                        $matches
                    );
                    return;
                }
            }
        }

        $this->abort();
    }

    public function abort(){
        http_response_code(404);
        echo "404 - Page not found";
        exit;
    }
}
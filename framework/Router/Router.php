<?php

namespace Framework\Router;

use Exception;

class Router
{

    public function __construct(
        protected array $routes = []
    )
    {
    }

    public function addRoute(string $method, string $pattern, mixed $handler) : void
    {
        $this->routes[$method][] = new Route($pattern, $handler);
    }

    /**
     * @throws Exception
     */
    public function dispatch($method, $uri)
    {
        if (!isset($this->routes[$method])) {
            throw new Exception('Method not allowed', 405);
        }

        foreach ($this->routes[$method] as $route) {
            if ($params = $route->match($uri)) {

                array_shift($params);

                return $route->handler($params);
            }
        }

        throw new Exception('Page not found', 404);
    }

}
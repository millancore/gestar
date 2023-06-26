<?php

namespace Xfrmk\Router;

use Exception;

class Route
{
    public function __construct(
        readonly string $path,
        readonly mixed $handler
    )
    {
        //
    }


    /**
     * Match the route with the uri
     * @param string $uri
     * @return array|false
     */
    public function match(string $uri): array|false
    {
        $pattern = preg_replace('/\//', '\/', $this->path);
        $pattern = '/^' . $pattern . '$/';

        if (!preg_match($pattern, $uri, $matches)) {
            return false;
        }

        return $matches;
    }

    /**
     * Handle the route Closure or [Controller::class, 'method']
     * @throws Exception
     */
    public function handler(array $params): mixed
    {
        if (is_callable($this->handler)) {
            return call_user_func_array($this->handler, $params);
        }

        if (is_array($this->handler)) {

            //Validate if array has two elements
            if (count($this->handler) !== 2) {
                throw new Exception("Invalid handler");
            }

            [$controller, $method] = $this->handler;

            //Validate if first element is a valid class
            if (!class_exists($controller)) {
                throw new Exception("Class $controller not found");
            }

            //Validate if second element is a valid method
            if (!method_exists($controller, $method)) {
                throw new Exception("Method $method not found");
            }


            return (new $controller)->$method(...$params);
        }

        return $this->handler;
    }

}
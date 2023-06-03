<?php

namespace Framework\Router;

use Closure;
use SplObjectStorage;

class RouteCollection extends SplObjectStorage
{
    public function add(string $method, string $pattern, Closure|array $handler) : void
    {
        $this->attach((object)[
            'method' => $method,
            'pattern' => $pattern,
            'handler' => $handler]
        );
    }
}
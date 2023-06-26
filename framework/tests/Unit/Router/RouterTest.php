<?php

namespace Xfrmk\Tests\Unit\Router;

use Exception;
use Xfrmk\Router\Router;
use Xfrmk\Tests\TestCase;

class RouterTest extends TestCase
{
    public function test_it_route_can_match_with_url()
    {
        $router = new Router();

        $router->addRoute('GET', '/hello', fn () => 'Hello World');
        $handlerResponse = $router->dispatch('GET', '/hello');

        $this->assertEquals('Hello World', $handlerResponse);
    }

    public function test_it_router_match_with_params()
    {
        $router = new Router();

        $router->addRoute('GET', '/hello/(\w+)', fn ($name) => "Hello $name");
        $handlerResponse = $router->dispatch('GET', '/hello/John');

        $this->assertEquals('Hello John', $handlerResponse);
    }


    public function test_it_route_throw_exception_page_not_found()
    {
        // Todo: using router exception
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Page not found');


        $router = new Router();

        $router->addRoute('GET', '/hello', fn () => 'Hello World');
        $router->dispatch('GET', '/invalid/path');
    }

    public function test_it_route_throw_exception_method_no_allow()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Method not allowed');

        $router = new Router();

        $router->addRoute('GET', '/hello', fn () => 'Hello World');
        $router->dispatch('POST', '/hello');
    }

}
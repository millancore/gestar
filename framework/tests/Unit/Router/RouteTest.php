<?php

namespace Xfrmk\Tests\Unit\Router;

use ArgumentCountError;
use Exception;
use Xfrmk\Router\Route;
use Xfrmk\Tests\TestCase;

class RouteTest extends TestCase
{
    public function test_it_route_return_match_array()
    {
        $route = new Route('/hello', fn () => 'Hello World');

        $this->assertIsArray($route->match('/hello'));
        $this->assertEquals(['/hello'], $route->match('/hello'));
    }

    public function test_it_route_return_false_if_not_match()
    {
        $route = new Route('/hello', fn () => 'Hello World');

        $this->assertFalse($route->match('/world'));
    }

    public function test_it_route_return_handler()
    {
        $route = new Route('/hello', fn () => 'Hello World');

        $this->assertEquals('Hello World', $route->handler([]));
    }

    public function test_it_route_return_handler_with_params()
    {
        $route = new Route('/hello/{name}', fn ($name) => "Hello $name");

        $this->assertEquals('Hello John', $route->handler(['John']));
    }

    public function test_it_route_throw_exception_if_handler_invalid()
    {
        $route = new Route('/hello/{name}', fn ($name) => "Hello $name");

        $this->expectException(ArgumentCountError::class);

        $route->handler();
    }

    public function test_it_route_return_handler_with_class_controller()
    {
        $route = new Route('/hello', [HelloController::class, 'index']);

        $this->assertEquals('Hello World', $route->handler([]));
    }

    public function test_it_route_return_handler_with_class_controller_and_params()
    {
        $route = new Route('/hello/{name}', [HelloController::class, 'show']);

        $this->assertEquals('Hello John', $route->handler(['John']));
    }

    public function test_it_route_throw_exception_if_class_controller_invalid()
    {
        $route = new Route('/hello/{name}', ['//InvalidControllerClass', 'index']);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Class //InvalidControllerClass not found');

        $route->handler([]);
    }








}
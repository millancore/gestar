<?php

use Framework\Router\Route;
use Tests\Framework\Unit\Router\HelloController;

test('route match', function () {
    $route = new Route('/hello', fn () => 'Hello World');

    expect($route->match('/hello'))->toBeArray();
    expect($route->match('/hello'))->toMatchArray(['/hello']);

    $this->assertFalse($route->match('/world'));
});

test('route handler', function () {
    $route = new Route('/hello', fn () => 'Hello World');

    $this->assertEquals('Hello World', $route->handler([]));
});

test('route handler with params', function () {
    $route = new Route('/hello/{name}', fn ($name) => "Hello $name");

    $this->assertEquals('Hello John', $route->handler(['John']));
});

test('route handler with invalid params', function () {
    $route = new Route('/hello/{name}', fn ($name) => "Hello $name");

    $this->expectException(ArgumentCountError::class);

    $route->handler();
});

test('class controller handler', function () {
    $route = new Route('/hello', [HelloController::class, 'index']);

    $this->assertEquals('Hello World', $route->handler([]));
});

test('class controller handler with params', function () {
    $route = new Route('/hello/{name}', [HelloController::class, 'show']);

    $this->assertEquals('Hello John', $route->handler(['John']));
});

test('class controller handler invalid ', function (){
    $route = new Route('/hello/{name}', ['//InvalidControllerClass', 'index']);

    $this->expectException(Exception::class);

    $route->handler([]);
});



<?php

use Framework\Router\Router;

test('router match', function () {
    $router = new Router();

    $router->addRoute('GET', '/hello', fn () => 'Hello World');
    $handlerResponse = $router->dispatch('GET', '/hello');

    expect($handlerResponse)->toBe('Hello World');
});

test('router match with params', function () {
    $router = new Router();

    $router->addRoute('GET', '/hello/(\w+)', fn ($name) => "Hello $name");
    $handlerResponse = $router->dispatch('GET', '/hello/John');

    expect($handlerResponse)->toBe('Hello John');
});

test('router not found page', function () {
    $router = new Router();

    $router->addRoute('GET', '/hello', fn () => 'Hello World');
    $router->dispatch('GET', '/invalid/path');

})->throws(Exception::class,'Page not found');


test('router method not allowed', function () {
    $router = new Router();

    $router->addRoute('GET', '/hello', fn () => 'Hello World');
    $router->dispatch('POST', '/hello');

})->throws(Exception::class,'Method not allowed');
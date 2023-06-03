<?php

use Framework\Http\Request;

test('create request from globals', function (){
    $request = Request::createFromGlobals();

    expect($request->get)->toBe($_GET)
        ->and($request->post)->toBe($_POST)
        ->and($request->cookies)->toBe($_COOKIE)
        ->and($request->files)->toBe($_FILES)
        ->and($request->server)->toBe($_SERVER);
});

test('get request method', function (){
    $request = new Request([], [], [], [], [
        'REQUEST_METHOD' => 'GET'
    ]);

    expect($request->getMethod())->toBe('GET');
});


test('get path info', function (){
    $request = new Request([], [], [], [], [
        'REQUEST_URI' => '/hello?query=params'
    ]);

    expect($request->getPathInfo())->toBe('/hello');
});
<?php

use Framework\Http\Response;

test('create response', function () {
    $response = new Response(
        content: 'Hello World',
        status: 200,
        headers: [
            'Content-Type: text/html'
        ]
    );

    expect($response->getContent())->toBe('Hello World')
        ->and($response->getStatusCode())->toBe(200)
        ->and($response->getHeaders())->toBe([
            'Content-Type: text/html'
        ]);

});

test('send response', function () {
    $response = new Response(
        content: 'Hello World',
        status: 200,
        headers: [
            'Content-Type: text/html'
        ]
    );

    ob_start();
    $response->send();
    $content = ob_get_clean();

    expect($content)->toBe('Hello World');
});
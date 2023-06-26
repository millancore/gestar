<?php

namespace Xfrmk\Tests\Unit\Router;

class HelloController
{

    function index(): string
    {
        return 'Hello World';
    }

    function show($name): string
    {
        return "Hello $name";
    }
}
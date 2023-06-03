<?php

namespace tests\Framework\Unit\Router;

class HelloController
{
    function index()
    {
        return 'Hello World';
    }

    function show($name)
    {
        return "Hello $name";
    }
}
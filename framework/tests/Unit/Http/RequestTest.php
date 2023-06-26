<?php

namespace Xfrmk\Tests\Unit\Http;

use Xfrmk\Http\Request;
use Xfrmk\Tests\TestCase;

class RequestTest extends TestCase
{
    public function test_it_can_create_request_from_globals()
    {
        $request = Request::createFromGlobals();

        $this->assertEquals($_GET, $request->get);
        $this->assertEquals($_POST, $request->post);
        $this->assertEquals($_COOKIE, $request->cookies);
        $this->assertEquals($_FILES, $request->files);
        $this->assertEquals($_SERVER, $request->server);
    }

    public function test_it_can_get_request_method()
    {
        $request = new Request([], [], [], [], [
            'REQUEST_METHOD' => 'GET'
        ]);

        $this->assertEquals('GET', $request->getMethod());
    }

    public function test_it_can_get_path_info()
    {
        $request = new Request([], [], [], [], [
            'REQUEST_URI' => '/hello?query=params'
        ]);

        $this->assertEquals('/hello', $request->getPathInfo());
    }

}
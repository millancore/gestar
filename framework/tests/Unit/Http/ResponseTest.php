<?php

namespace Xfrmk\Tests\Unit\Http;

use Xfrmk\Http\Response;
use Xfrmk\Tests\TestCase;

class ResponseTest extends TestCase
{
     public function test_it_can_create_response()
     {
         $response = new Response(
             content: 'Hello World',
             status: 200,
             headers: [
                 'Content-Type: text/html'
             ]
         );

            $this->assertEquals('Hello World', $response->getContent());
            $this->assertEquals(200, $response->getStatusCode());
            $this->assertEquals([
                'Content-Type: text/html'
            ], $response->getHeaders());

     }

        public function test_it_can_send_response()
        {
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

            $this->assertEquals('Hello World', $content);
        }

}
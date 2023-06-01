<?php

namespace Framework\Http;

class Kernel
{
   public function handle(Request $request): Response
   {
       return new Response(
           content: 'Hello World',
           status: 200,
           headers: [
               'Content-Type: text/html'
           ]
       );
   }
}
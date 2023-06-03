<?php

namespace Framework\Http;

class Request
{
    public function __construct(
         public readonly array $get,
         public readonly array $post,
         public readonly array $cookies,
         public readonly array $files,
         public readonly array $server
    )
    {
        //
    }


   public static function createFromGlobals()
   {
       return new static($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER );
   }

    public function getMethod() : string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function getPathInfo() : string
    {
        return parse_url($this->server['REQUEST_URI'], PHP_URL_PATH);
    }

}
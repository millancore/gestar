<?php

declare(strict_types=1);

namespace Xfrmk\Http;

final class Request
{

    /**
     * @param array<string, mixed> $get
     * @param array<string, mixed> $post
     * @param array<string, mixed> $cookies
     * @param array<string, mixed> $files
     * @param array<string, string> $server
     */
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


   public static function createFromGlobals() : self
   {
       return new Request($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER );
   }

    public function getMethod() : string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function getPathInfo() : string
    {
        $pathInfo = parse_url($this->server['REQUEST_URI'], PHP_URL_PATH);

       return (string) $pathInfo;
    }

}
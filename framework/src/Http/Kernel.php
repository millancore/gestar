<?php

namespace Xfrmk\Http;

use Exception;
use Xfrmk\Router\Router;

class Kernel
{
   public function __construct(
       protected Router $router
   )
   {
       //
   }


   public function handle(Request $request): Response
   {
         try {
              return $this->router->dispatch($request->getMethod(), $request->getPathInfo());
         } catch (Exception $e) {
              return new Response($e->getMessage(), 400);
         }

   }
}
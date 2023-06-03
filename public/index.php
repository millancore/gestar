<?php declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

define('ROOT_APP', dirname(__DIR__));

use Framework\Http\Kernel;
use Framework\Http\Request;
use Framework\Router\Router;

$request = Request::createFromGlobals();
$router = new Router();

$router->addCollection(require ROOT_APP . '/routes/web.php');

(new Kernel($router))->handle($request)->send();



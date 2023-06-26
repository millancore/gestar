<?php declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

define('ROOT_APP', dirname(__DIR__));

use Xfrmk\Http\Kernel;
use Xfrmk\Http\Request;
use Xfrmk\Router\Router;
use Xfrmk\View\Config;
use Xfrmk\View\Resolver;

// Load Config
try {
    \Xfrmk\Config\Config::load(ROOT_APP . '/.env');
} catch (Exception $e) {
    die($e->getMessage());
}

$viewResolver = Resolver::getInstance();

$viewResolver->config(
    (new Config())
        ->setViewDir(ROOT_APP . '/views')
        ->setExtension(false)
);


$request = Request::createFromGlobals();
$router = new Router();

$router->addCollection(require ROOT_APP . '/routes/web.php');

(new Kernel($router))->handle($request)->send();



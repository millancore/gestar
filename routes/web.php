<?php

use Framework\Router\RouteCollection;
use Taskwarrior\Http\TaskController;

$routes = new RouteCollection;

$routes->add('GET', '/', [TaskController::class, 'list']);

$routes->add('POST', '/', function () {
    // Create Task in taskwarrior
    shell_exec(sprintf('task add %s', escapeshellarg($_POST['description'])));

    // redirect to index
    header('Location: /');
});

return $routes;


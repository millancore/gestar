<?php declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Framework\Router\Router;


$router = new Router();

$router->addRoute('GET', '/', function () {
    echo 'Hello World';
    die;
});

$router->addRoute('GET', '/hello/(\w+)', function ($name) {
    echo "Hello $name";
    die;
});

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);


if (!empty($_POST['description'])) {
    // Create Task in taskwarrior
    shell_exec(sprintf('task add %s', escapeshellarg($_POST['description'])));

    // redirect to index
    header('Location: /');
    exit;
}


use Taskwarrior\Command;

$data = (new Command('task status:pending export'))
        ->toArray();
?>

<!-- Form to create a new task -->
<form action="/" method="post">
    <input type="text" name="description" placeholder="Description">
    <button type="submit">Create</button>

<!--Show tasks html list-->
<ul>
    <?php foreach ($data as $task) : ?>
        <li>
            <a href="task.php?id=<?= $task->id ?>">
                <?= $task->description ?>
            </a>
        </li>
    <?php endforeach; ?>


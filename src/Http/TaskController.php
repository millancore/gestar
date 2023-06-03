<?php

namespace Taskwarrior\Http;

use Framework\Http\Response;
use Taskwarrior\Command;

class TaskController
{
    public function list()
    {
        $data = (new Command('task status:pending export'))->toArray();

        $content = '
<form action="/" method="post">
    <input type="text" name="description" placeholder="Description">
    <button type="submit">Create</button>
    
<ul>';

        foreach ($data as $task) {
            $content .= sprintf(
                '<li><a href="task.php?id=%s">%s</a></li>',
                $task->id,
                $task->description
            );
        }

        $content .= '</ul>';

        return new Response(
            $content,
            200,
            ['Content-Type: text/html']
        );

    }

    public function store()
    {
        // Create Task in taskwarrior
        shell_exec(sprintf('task add %s', escapeshellarg($_POST['description'])));

        // redirect to index
        header('Location: /');
    }

}
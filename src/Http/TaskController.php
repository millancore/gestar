<?php

namespace Gestar\Http;

use Xfrmk\DB\MySqlConnection;
use Xfrmk\DB\QueryBuilder;
use Xfrmk\Http\Response;
use Xfrmk\View\View;

class TaskController
{
    public function list()
    {
        $tasks = [
            [
                'id' => 1,
                'description' => 'Buy milk'
            ],
        ];


        return new Response(
            View::render('create_task', compact('tasks')),
            200,
            ['Content-Type: text/html']
        );

    }

    /**
     * Save Task in DB
     * @return void
     */
    public function store()
    {
        $dbConnection = new MySqlConnection(
            $_ENV['DB_HOST'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD'],
            $_ENV['DB_DATABASE'],
        );

        $query = (new QueryBuilder())
        ->insert('tasks', [
            'description' => $_POST['description'],
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
        ]);



    }

}
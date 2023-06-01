<?php

namespace Taskwarrior;

class TaskCollection
{
    // Create a collection of Task
    public function __construct(
        private array $tasks
    )
    {
    }

}
<?php

namespace Taskwarrior;

class Command
{
    public function __construct(
        private string $command
    )
    {
    }

    public function exec(): string
    {
        return shell_exec($this->command);
    }

    public function toArray() : array
    {
        $data = [];

        $output = $this->exec();

        if ($output === null) {
            echo "Failed to execute the command.";
        } else {
            $data = json_decode($output);
        }

        return $data;

    }


}
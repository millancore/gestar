<?php

namespace Taskwarrior\Entity;

use DateTimeImmutable;
use Framework\ORM;
use Framework\ORM\EntityInterface;
use Taskwarrior\Enum\Status;

#[ORM\Entity]
#[ORM\Table(name: 'tasks')]
class Task implements EntityInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    public ?int $id;

    #[ORM\Column(type: 'string')]
    public string $description;

    #[ORM\Column(type: 'int')]
    public Status $status;

    #[ORM\Column(type: 'datetime')]
    public DateTimeImmutable $createdAt;

    public function __construct()
    {
        //
    }

}
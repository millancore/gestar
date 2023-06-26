<?php

namespace Gestar\Entity;

use DateTimeImmutable;
use Framework\ORM;
use Xfrmk\ORM\EntityInterface;
use Taskwarrior\Enum\Status;

#[\Xfrmk\ORM\Table(name: 'tasks')]
class Task implements EntityInterface
{
    #[\Xfrmk\ORM\Id]
    #[\Xfrmk\ORM\Column(type: 'integer')]
    public ?int $id;

    #[\Xfrmk\ORM\Column(type: 'string')]
    public string $description;

    #[\Xfrmk\ORM\Column(type: 'int')]
    public Status $status;

    #[\Xfrmk\ORM\Column(type: 'datetime')]
    public DateTimeImmutable $createdAt;

    public function __construct()
    {
        //
    }

}
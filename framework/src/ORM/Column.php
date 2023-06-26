<?php

namespace Xfrmk\ORM;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)] class Column
{
    public function __construct(
        public string $name,
        public string $type,
        public int $length = 255,
        public bool $nullable = false,
        public bool $unique = false,
        public bool $primary = false,
        public bool $autoincrement = false,
        public ?string $default = null
    ) { }




}
<?php

namespace Xfrmk\ORM;

use Attribute;

#[Attribute] class Id
{
    public function __construct(
        public string $name = 'id'
    ) { }
}
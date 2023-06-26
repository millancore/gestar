<?php

namespace Xfrmk\ORM;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)] class Table
{
    public function __construct(
        public string $name
    ) { }



}
<?php

namespace DR2GSistemas\korm\classes;


use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class DatabaseBuilder
{
    public function __construct(array $tables = [])
    {
        $this->tables = $tables;
    }

}

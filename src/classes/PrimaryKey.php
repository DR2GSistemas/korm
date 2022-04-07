<?php


namespace DR2GSistemas\korm\classes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class PrimaryKey
{
    public function __construct($name, $autoIncrement = false)
    {
        $this->name = $name;
        $this->autoIncrement = $autoIncrement;
    }

}

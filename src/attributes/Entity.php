<?php


namespace DR2GSistemas\korm\attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Entity
{

    public function __construct(public string $name)
    {
    }

    /**
     * Retorna el nombre de la tabla
     * @return string
     */
    public function getTablename(): string
    {
        return strtolower($this->name);
    }
}

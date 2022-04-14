<?php


namespace DR2GSistemas\korm\classes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Table
{

    public function __construct(string $tablename)
    {
        $this->tablename = $tablename;
    }

    /**
     * Retorna el nombre de la tabla
     * @return string
     */
    public function getTablename(): string
    {
        return $this->tablename;
    }


}

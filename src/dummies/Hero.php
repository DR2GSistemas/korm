<?php


namespace DR2GSistemas\korm\dummies;


use DR2GSistemas\korm\classes\Column;
use DR2GSistemas\korm\classes\Entity;


class Hero extends Entity
{
    /**
     * @PrimaryKey
     * @AutoIncrement
     */

    #[Column("codigo", "int", true)]
    public int $codigo;

    #[Column("nombre", "varchar(100)")]
    public string $name;

    public function __construct()
    {
        $this->tablename = "heroes";
    }


}

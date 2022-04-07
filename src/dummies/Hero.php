<?php


namespace DR2GSistemas\korm\dummies;


use DR2GSistemas\korm\classes\Column;
use DR2GSistemas\korm\classes\Entity;
use DR2GSistemas\korm\classes\Index;
use DR2GSistemas\korm\classes\PrimaryKey;

class Hero extends Entity
{
    /**
     * @PrimaryKey
     * @AutoIncrement
     */
    #[PrimaryKey(true)]
    #[Column("codigo", "int")]
    public int $codigo;

    #[Column("nombre", "varchar(100)")]
    #[Index()]
    public string $name;

    public function __construct()
    {
        $this->tablename = "heroes";
    }


}

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

    #[Column("int", autoincrement: true, primarykey: true)]
    public int $codigo;

    #[Column("varchar(100)")]
    public string $nombre;

    public function __construct()
    {
        $this->tablename = "heroes";
    }


}

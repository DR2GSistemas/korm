<?php


namespace DR2GSistemas\korm\dummies;


use DR2GSistemas\korm\classes\Column;
use DR2GSistemas\korm\classes\Entity;
use DR2GSistemas\korm\classes\Index;


class Hero extends Entity
{
    #[Column("int", autoincrement: true, primarykey: true)]
    public int $codigo;

    #[Column("varchar", length: 100)]
    #[Index(indexname: "idx_hero_1")]
    #[Index(indexname: "idx_hero_2", sort: 'DESC')]
    public string $nombre;

    public function __construct()
    {
        $this->tablename = "heroes";
    }


}

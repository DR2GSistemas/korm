<?php


namespace DR2GSistemas\korm\dummies;


use DR2GSistemas\korm\classes\Column;
use DR2GSistemas\korm\classes\Entity;


class Product extends Entity
{
    #[Column("int", autoincrement: true, primarykey: true)]
    public int $codigo;
    #[Column("varchar(100)", nullable: false)]
    public string $nombre;
    #[Column("numeric(10,2)")]
    public float $precio;
    #[Column("date")]
    public $date;


}

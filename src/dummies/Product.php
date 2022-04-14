<?php


namespace DR2GSistemas\korm\dummies;


use DR2GSistemas\korm\classes\Column;
use DR2GSistemas\korm\classes\Entity;


class Product extends Entity
{
    #[Column("codigo", "int", true)]
    public int $codigo;
    #[Column("nombre", "varchar(100)", false, false, true)]
    public string $name;
    #[Column("precio", "numeric(10,2)")]
    public float $value;
    #[Column("date", "date")]
    public $date;


}

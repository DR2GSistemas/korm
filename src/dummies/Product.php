<?php


namespace DR2GSistemas\korm\dummies;


use DR2GSistemas\korm\classes\Column;
use DR2GSistemas\korm\classes\Entity;
use DR2GSistemas\korm\classes\PrimaryKey;

class Product extends Entity
{
    #[Column("codigo", "int")]
    #[PrimaryKey(true)]
    public int $codigo;
    #[Column("nombre", "varchar(100)")]
    public string $name;
    #[Column("precio", "numeric(10,2)")]
    public float $value;


}

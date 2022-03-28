<?php


namespace DR2GSistemas\korm\dummies;


use DR2GSistemas\korm\classes\Entity;

class Product extends Entity
{
    public int $codigo;
    public string $name;
    public float $value;

    /**
     * Product constructor.
     */
    public function __construct()
    {
//        $this->tablename="products";
    }


}

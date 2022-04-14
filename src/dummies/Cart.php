<?php


namespace DR2GSistemas\korm\dummies;


use DR2GSistemas\korm\classes\Entity;
use DR2GSistemas\korm\classes\ForeignKey;

class Cart extends Entity
{

    public $id;
    public $user_id;
    #[ForeignKey(indexName: "fk_product_id", table: "product", column: "codigo")]
    public $product_id;
    public $quantity;
    public $created_at;
    public $updated_at;

    public function __construct()
    {
        $this->tablename = 'carts';
    }

}



<?php


namespace DR2GSistemas\korm\dummies;


use DR2GSistemas\korm\classes\Column;
use DR2GSistemas\korm\classes\Entity;
use DR2GSistemas\korm\classes\ForeignKey;
use DR2GSistemas\korm\classes\Index;

class Cart extends Entity
{
    #[Column(type: "int", primarykey: true, autoincrement: true)]
    public $id;
    #[Column(type: "int")]
    #[Index("idx_cart_user_id", sort: "DESC")]
    #[ForeignKey(indexname: "fk_cart_user_id", table: "users", column: "id")]
    public $user_id;
    #[Column(type: "int")]
    #[ForeignKey(indexname: "fk_product_id", table: "products", column: "codigo")]
    public $product_id;
    #[Column(type: "numeric(10,2)")]
    public $quantity;
    #[Column(type: "timestamp", nullable: false, default: 'current_timestamp')]
    #[Index("idx_cart_created_at", sort: "ASC")]
    public $created_at;
    #[Column(type: "timestamp", nullable: false, onUpdate: 'current_timestamp')]
    #[Index("idx_cart_updated_at", sort: "DESC")]
    public $updated_at;

    public function __construct()
    {
        $this->tablename = 'carts';
    }

}



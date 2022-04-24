<?php

namespace DR2GSistemas\korm\dummies;

use DR2GSistemas\korm\classes\Column;
use DR2GSistemas\korm\classes\Entity;
use DR2GSistemas\korm\classes\Index;

class User extends Entity
{
    #[Column(type: "int", primarykey: true, autoincrement: true)]
    public $id;
    #[Column(type: "string", length: 255)]
    #[Index(indexname: "idx_user_1", unique: true)]
    public $name;
    #[Column(type: "timestamp", default: 'CURRENT_TIMESTAMP')]
    public $created_at;


    public function __construct()
    {
        $this->tablename = "users";
    }

}

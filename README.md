#DR2GSISTEMAS Package korm

Pseudo library orm utils

Don't use in production, is just for fun and practice!

## Usage

````PHP
<?php

use DR2GSistemas\korm\classes\Entity;

class Product extends Entity {
    //typed public fields
    public int $id;
    public string $name;
    public float $price;

    public function __construct() {
        //optional: can define your tablename in the constructor
        $this->tablename = 'products';
    }

}


/*init a new instance*/
$product = new Product();
/*or create from json*/
$product = Product::fromJson(["name"=>"sugar", "id"=>1, "price"=>3.59]);

/*populate from array...*/
$product->populate(["name"=>"sugar", "id"=>1, "price"=>3.59]);

/*build a insert statement*/
$stmt = $product->insert();

/*build a update statement*/
$product->name = "sugar rainbow"; /* changed */
$product->price = "4.59";
$stmt = $product->update();

/*build delete statemet*/
$stmt = $product->delete();


/*execute the stmt in a favorite conection */
GhostlyDatabaseInstanceManager::getInstace()->executeOrFail($stmt);



````

history

dev-0.1: init the journey


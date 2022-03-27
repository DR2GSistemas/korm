# DR2GSISTEMAS Package: korm

Pseudo library to be a orm utility.

**:skull: Don't use in production, is just for fun and practice!**

**:skull: No utilice en producción, es solo por diversión y practica**

## Usage/Uso

````PHP
<?php

use DR2GSistemas\korm\classes\Entity;


/*Declare a class and extends with Entity class*/
/*Declarar la clase extendiendo con Entity*/
class Product extends Entity {
    //typed public fields
    //variables publicas tipadas
    public int $id;
    public string $name;
    public float $price;

    public function __construct() {
        //optional: can define your tablename in the constructor
        //opcional: se puede definir el nombre de la tabla en el contructor
        $this->tablename = 'products';
    }

}


/*init a new instance*/
/*iniciar la instancia*/
$product = new Product();
/*or create from json*/
/*o desde un json*/
$product = Product::fromJson(["name"=>"sugar", "id"=>1, "price"=>3.59]);

/*populate from array...*/
/*poblar con un array...*/
$product->populate(["name"=>"sugar", "id"=>1, "price"=>3.59]);

/*build a insert statement*/
/*construir la sentencia de inserción*/
$stmt = $product->insert();

/*build a update statement*/
/*construir la sentencia de actualización*/
$product->name = "sugar rainbow"; /* changed */
$product->price = "4.59";
$stmt = $product->update();

/*build delete statement*/
/*construir la sentencia de borrado*/
$stmt = $product->delete();


/*execute the stmt in a favorite conection */
/*ejecutar la sentencia en su conector favorito*/
GhostlyDatabaseInstanceManager::getInstace()->executeOrFail($stmt);



````
From Villeta, Paraguay with :sparkling_heart:
Desde Villeta, Paraguay con :sparkling_heart:


history

dev-0.1: init the journey


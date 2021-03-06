# DR2GSISTEMAS Package: korm

Pseudo library to be a orm utility.

**:skull: Don't use in production, is just for fun and practice!**

**:skull: No utilice en producción, es solo por diversión y practica**

## Usage/Uso

````PHP
<?php

use DR2GSistemas\korm\classes\Column;
use DR2GSistemas\korm\classes\Entity;
use DR2GSistemas\korm\classes\Index;


/*Declare a class and extends with Entity class*/
/*Declarar la clase extendiendo con Entity*/
class Product extends Entity {
    //typed public fields
    //variables publicas tipadas
    #[Column(type:"integer",  primaryKey:true, autoincrement:true)]
    public int $id;
    #[Column(type:"varchar(255)", nullable: false )]  //declare as field varchar(255) not null
    #[Index(indexname:"idx_product_name",unique: false)]  //declare as index with name idx_product_name and unique false
    public string $name;
    #[Column(type:"numeric(10,2)", nullable: true)]
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

**History**

- 0.1.0:
    - init the journey

- 0.1.1:
    - bugfix on detect primaryKeyFieldName on update() and insert()
    - bugfix on detect tablename fieldname on insert(), update() and delete()
    - add EntityTest.php for testing :godmode:

- 0.1.2:
    - some small fixes

- 0.1.3
    - add selectAll() and selectOne()

- 0.1.4
    - add DDLBuilder class
    - add IDDL interface for entities
        - public function _createDDL(): string;
        - public function _dropDDL(): string;
        - public function _createIndexesDDL(): array;
        - public function _dropIndexesDDL(): array;
        - public function _createForeignKeysDDL(): array;
        - public function _dropForeignKeysDDL(): array;
        - public function _resetAutoIncrement(int $value = 1): string;

**Todo:**

- [x] add functions selectAll() and selectOne()
- [x] test functions selectAll() and selectOne()
- [ ] Reach better performance on build statements :speedboat:
- [ ] Relations :link:
- [ ] Conectors :electric_plug:
- [x] Build from classes to database scheme :electric_plug:
- [ ] Build classes from database scheme :building_construction:
- [ ] Do better documentation :book:
- [ ] Enjoy a :beer: of a contributor :smile: (optional)

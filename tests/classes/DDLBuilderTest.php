<?php

namespace DR2GSistemas\korm\tests\classes;

use DR2GSistemas\korm\classes\DDLBuilder;
use DR2GSistemas\korm\dummies\Cart;
use DR2GSistemas\korm\dummies\Hero;
use DR2GSistemas\korm\dummies\Product;
use PHPUnit\Framework\TestCase;

class DDLBuilderTest extends TestCase
{

    public function testCreateTableFromHero()
    {
        $ddl = new DDLBuilder();
        $stmt = $ddl->createTable(Hero::class);
        $correct_stmt = "CREATE TABLE heroes (codigo int PRIMARY KEY AUTO_INCREMENT, nombre varchar(100))";
        $this->assertEquals($correct_stmt, $stmt);

    }

    public function testCreateTableFromProduct()
    {
        $ddl = new DDLBuilder();
        $stmt = $ddl->createTable(Product::class);
        $correct_stmt = "CREATE TABLE products (codigo int PRIMARY KEY AUTO_INCREMENT, nombre varchar(100) NOT NULL, precio numeric(10,2), date date)";
        $this->assertEquals($correct_stmt, $stmt);
    }

    public function testIDDL_createDDL()
    {

        $product = new Product();
        $stmt = $product->_createDDL();
        $correct_stmt = "CREATE TABLE products (codigo int PRIMARY KEY AUTO_INCREMENT, nombre varchar(100) NOT NULL, precio numeric(10,2), date date)";
        $this->assertEquals($correct_stmt, $stmt);

        $hero = new Hero();
        $stmt = $hero->_createDDL();
        $correct_stmt = "CREATE TABLE heroes (codigo int PRIMARY KEY AUTO_INCREMENT, nombre varchar(100))";
        $this->assertEquals($correct_stmt, $stmt);
    }

    public function testIDDL_deleteDDL()
    {

        $product = new Product();
        $stmt = $product->_dropDDL();
        $correct_stmt = "DROP TABLE IF EXISTS products";
        $this->assertEquals($correct_stmt, $stmt);

        $hero = new Hero();
        $stmt = $hero->_dropDDL();
        $correct_stmt = "DROP TABLE IF EXISTS heroes";
        $this->assertEquals($correct_stmt, $stmt);

    }

    public function testIDDL_createIndex()
    {

        $product = new Product();
        $stmt = $product->_createIndexesDDL();
        $correct_stmt = "ALTER TABLE products ADD INDEX idx_nombre (nombre)";
        $this->assertEquals($correct_stmt, $stmt[0]);

    }

    public function testIDDL_dropIndex()
    {

        $product = new Product();
        $stmt = $product->_dropIndexesDDL();
        $correct_stmt = "ALTER TABLE products DROP INDEX idx_nombre";
        $this->assertEquals($correct_stmt, $stmt[0]);

    }

    public function testIDDL_createForeignkey()
    {

        $product = new Cart();
        $stmt = $product->_createForeignKeysDDL();
        $correct_stmt = "ALTER TABLE carts ADD CONSTRAINT fk_product_id FOREIGN KEY (product_id) REFERENCES product(codigo) ON DELETE RESTRICT ON UPDATE RESTRICT";
        $this->assertEquals($correct_stmt, $stmt[0]);

    }

    public function testIDDL_dropForeignkey()
    {

        $product = new Cart();
        $stmt = $product->_dropForeignKeysDDL();
        $correct_stmt = "ALTER TABLE carts DROP FOREIGN KEY fk_product_id";
        $this->assertEquals($correct_stmt, $stmt[0]);

    }

    public function testIDDL_resetAutoincrement()
    {

        $product = new Product();
        $stmt = $product->_resetAutoincrement();
        $correct_stmt = "ALTER TABLE products AUTO_INCREMENT = 1";
        $this->assertEquals($correct_stmt, $stmt);

        $hero = new Hero();
        $stmt = $hero->_resetAutoincrement(55);
        $correct_stmt = "ALTER TABLE heroes AUTO_INCREMENT = 55";
        $this->assertEquals($correct_stmt, $stmt);

    }


}

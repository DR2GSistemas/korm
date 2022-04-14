<?php

namespace DR2GSistemas\korm\tests\classes;

use DR2GSistemas\korm\classes\DDLBuilder;
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


}

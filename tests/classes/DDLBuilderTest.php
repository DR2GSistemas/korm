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
        $ddl = DDLBuilder::createTable(Hero::class);
        $this->assertEquals(
            'CREATE TABLE heroes (codigo int, nombre varchar(100))'
            , $ddl);

    }

    public function testCreateTableFromProduct()
    {
        $ddl = DDLBuilder::createTable(Product::class);
        $this->assertEquals(
            'CREATE TABLE products (codigo int, nombre varchar(100), precio numeric(10,2))'
            , $ddl);
    }


}

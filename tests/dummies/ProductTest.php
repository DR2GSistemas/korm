<?php

namespace DR2GSistemas\korm\tests\dummies;

use DR2GSistemas\korm\dummies\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public ?array $test_data = null;

    public function testStaticCall()
    {
        $product = Product::fromJson($this->test_data);
        self::assertEquals("products", $product->getTablename());

    }

    public function testCall()
    {
        $product = new Product();
        self::assertEquals("products", $product->getTablename());
    }

    public function testInsert()
    {
        $product = new Product();
        $product->populate($this->test_data);
        self::assertEquals("insert into products (name,value) values ('test product',12.34)", $product->insert());

    }

    public function testUpdate()
    {
        $product = new Product();
        $product->populate($this->test_data);
        $product->populate(["codigo" => 1]);
        self::assertEquals("update products set name='test product',value=12.34 where codigo=1", $product->update());
    }

    public function testDelete()
    {
        $product = Product::fromJson($this->test_data);
        $product->codigo = 1;
        self::assertEquals("delete from products where codigo=1", $product->delete());

    }

    protected function setUp(): void
    {
        $this->test_data = ["name" => "test product", "value" => 12.34];

    }


}

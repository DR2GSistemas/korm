<?php

namespace DR2GSistemas\korm\tests\dummies;

use DR2GSistemas\korm\dummies\Hero;
use PHPUnit\Framework\TestCase;


class HeroTest extends TestCase
{
    public ?array $test_data = null;

    public function testStaticCall()
    {
        $hero = Hero::fromJson($this->test_data);
        self::assertEquals("heros", $hero->getTablename());

    }

    public function testCall()
    {
        $hero = new Hero();
        self::assertEquals("heros", $hero->getTablename());
    }

    public function testInsert()
    {
        $hero = Hero::fromJson($this->test_data);
        self::assertEquals("insert into heros (name) values ('the batman')", $hero->insert());

    }

    public function testUpdate()
    {
        $hero = Hero::fromJson($this->test_data);
        $hero->populate(["codigo" => 1]);
        self::assertEquals("update heros set name='the batman' where codigo=1", $hero->update());
        $hero->populate(["codigo" => 200]);
        self::assertEquals("update heros set name='the batman' where codigo=200", $hero->update());

    }

    public function testDelete()
    {
        $hero = Hero::fromJson($this->test_data);
        $hero->populate(["codigo" => 1]);
        self::assertEquals("delete from heros where codigo=1", $hero->delete());
    }

    public function testSelectAll()
    {
        $hero = Hero::fromJson($this->test_data);
        self::assertEquals("select * from heros", $hero->selectAll());
    }

    public function testSelectOne()
    {
        $hero = Hero::fromJson($this->test_data);
        $hero->populate(["codigo" => 1]);
        self::assertEquals("select * from heros where codigo=1", $hero->selectOne(1));
    }


    protected function setUp(): void
    {
        $this->test_data = ["name" => "the batman"];

    }


}

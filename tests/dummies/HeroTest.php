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
        self::assertEquals("heroes", $hero->getTablename());

    }

    public function testCall()
    {
        $hero = new Hero();
        self::assertEquals("heroes", $hero->getTablename());
    }

    public function testInsert()
    {
        $hero = Hero::fromJson($this->test_data);
        self::assertEquals("insert into heroes (name) values ('the batman')", $hero->insert());

    }

    public function testUpdate()
    {
        $hero = Hero::fromJson($this->test_data);
        $hero->populate(["codigo" => 1]);
        self::assertEquals("update heroes set name='the batman' where codigo=1", $hero->update());
        $hero->populate(["codigo" => 200]);
        self::assertEquals("update heroes set name='the batman' where codigo=200", $hero->update());

    }

    public function testDelete()
    {
        $hero = Hero::fromJson($this->test_data);
        $hero->populate(["codigo" => 1]);
        self::assertEquals("delete from heroes where codigo=1", $hero->delete());

    }

    protected function setUp(): void
    {
        $this->test_data = ["name" => "the batman"];

    }


}

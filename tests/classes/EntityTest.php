<?php

declare(strict_types=1);

namespace DR2GSistemas\korm\tests\classes;

use DR2GSistemas\korm\classes\Entity;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{
    public ?array $test_data = null;

    public function testListaAll()
    {
        $entity = Entity::fromJson($this->test_data);
        self::assertEquals("select * from entities", $entity->listaAll());
        $entity = null;
        unset($entity);
    }

    public function testUpdate()
    {
        $entity = Entity::fromJson($this->test_data);
        $entity->populate(["codigo" => 100]);
        $entity->primaryKeyFieldName = "codigo";
        $stmt_espected = "update entities set name='test',value=123,bool=1,floating=123.456 where codigo=100";
        self::assertEquals($stmt_espected, $entity->update(false));
        unset($entity);
    }

    public function testFromJson()
    {
        $entity = Entity::fromJson($this->test_data);
        self::assertNotNull($entity, "Error al inicializar la instancia con fromJson()");
        unset($entity);
    }

    public function testGetTablename()
    {
        $entity = new Entity();
        self::assertEquals("entities", $entity->getTablename());
    }

    public function testPrimaryKeyFieldName()
    {
        $entity = new Entity();
        self::assertEquals("codigo", $entity->getPrimaryKeyFieldName());
    }

    public function testDelete()
    {
        $entity = Entity::fromJson($this->test_data);
        $entity->codigo = 100;
        $primaryKeyFieldName = $entity->getPrimaryKeyFieldName() ?? 'codigo';
        $value = $entity->primaryKeyFieldName;
        self::assertEquals("delete from entities where codigo=100", $entity->delete());

    }

    public function testInsert()
    {

//        ["name" => "test", "value" => 123, "bool" => true, "floating" => 123.456, "_private" => "secret!", "details" => ["key" => "value"]]
        $entity = Entity::fromJson($this->test_data);
        $stamente_expected = "insert into entities (name,value,bool,floating,nullable) values ('test',123,1,123.456,null)";
        self::assertEquals($stamente_expected, $entity->insert());


        $entity = null;
        unset($entity);
    }

    public function testInsertOrUpdate()
    {

        $entity = Entity::fromJson($this->test_data);
        $entity->codigo = 100; //check if  hast primarykeyfieldname value to prevent duplication
        $stmt_espected = "update entities set name='test',value=123,bool=1,floating=123.456,nullable=null where codigo=100";

        self::assertEquals($stmt_espected, $entity->insert());

        $entity = null;
        unset($entity);
    }

    public function testClassTablename()
    {
        $entity = new Entity();
        self::assertEquals("entities", $entity->getTablename());

        $entity = null;
        unset($entity);
    }

    public function testCustomTablename()
    {
        $entity = new Entity();
        $entity->tablename = "customers";
        self::assertEquals("customers", $entity->getTablename());

        $entity = null;
        unset($entity);
    }

    public function testPopulate()
    {
        $entity = new Entity();
        $entity->populate($this->test_data);

        self::assertObjectHasAttribute("name", $entity, "string field");
        self::assertObjectHasAttribute("value", $entity, "number field");
        self::assertObjectHasAttribute("floating", $entity, "floating field");
        self::assertObjectHasAttribute("bool", $entity, "boolean field");

        self::assertObjectNotHasAttribute("_private", $entity, "fail to filter private values");
        self::assertObjectNotHasAttribute("details", $entity, "failt to filter arrays");

        $entity = null;
        unset($entity);
    }

    protected function setUp(): void
    {
        $this->test_data = ["name" => "test", "value" => 123, "bool" => true, "floating" => 123.456, "_private" => "secret!", "details" => ["key" => "value"], "nullable" => null];
    }

    protected function tearDown(): void
    {
        $this->test_data = null;
        unset($this->test_data);
    }
}

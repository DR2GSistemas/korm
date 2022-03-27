<?php

namespace classes;

use DR2GSistemas\korm\classes\Entity;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{
    public function testPopulate()
    {
        $entity = new Entity();
        $entity->populate(["name" => "testing name", "number" => 1234, "floating" => 0.21, "boolean" => true, "details" => [], "_privateval" => "secret!"]);

        self::assertObjectHasAttribute("name", $entity);
        self::assertObjectHasAttribute("number", $entity);
        self::assertObjectHasAttribute("floating", $entity);
        self::assertObjectHasAttribute("boolean", $entity);

        self::assertObjectNotHasAttribute("_privateval", $entity);
        self::assertObjectNotHasAttribute("details", $entity);


    }


}

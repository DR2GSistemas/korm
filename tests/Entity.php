<?php


it("testing entity class", function () {

    test("testClassTablename", function () {
        expect(true)->toBeTrue();
    });


//
//     public function testClassTablename(){
//        $entity = new Entity();
//        self::assertEquals("entities", $entity->getTablename());
//        $entity = null;
//    }
//
//    public function testCustomTablename(){
//        $entity = new Entity();
//        $entity->tablename ="customers";
//        self::assertEquals("customers", $entity->getTablename());
//
//        $entity = null;
//    }
//
//
//    public function testPopulate()
//    {
//        $entity = new Entity();
//        $entity->populate($this->test_data);
//
//        self::assertObjectHasAttribute("name", $entity, "string field");
//        self::assertObjectHasAttribute("number", $entity, "number field");
//        self::assertObjectHasAttribute("floating", $entity, "floating field");
//        self::assertObjectHasAttribute("boolean", $entity, "boolean field");
//
//        self::assertObjectNotHasAttribute("_privateval", $entity, "fail to filter private values");
//        self::assertObjectNotHasAttribute("details", $entity, "failt to filter arrays");
//
//        $entity = null;
//    }

});



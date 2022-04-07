<?php


namespace DR2GSistemas\korm\classes;


use DR2GSistemas\korm\interfaces\IDDL;
use ReflectionClass;
use ReflectionException;

class DDLBuilder
{

    /**
     * @throws ReflectionException
     */
    public static function createTable($className): string
    {
        $class = new ReflectionClass($className);
        $entity = $class->newInstance();

        $ddl = "";
        $ddl .= "CREATE TABLE " . $entity->getTableName();

        $columns = [];
        $indexes = [];

        foreach ($class->getProperties() as $property) {
            foreach ($property->getAttributes(Column::class) as $column) {
                $c = $column->newInstance();
                $columns[] = $c->getName() . " " . $c->getType();
            }
            foreach ($property->getAttributes(Index::class) as $index) {
                $i = $index->newInstance();
                $indexes[] = $i->getDDL($entity->getTableName(), $property->getName());
            }

        }
        $ddl .= " (" . implode(", ", $columns) . "); ";
        $ddl .= implode("", $indexes);


        return $ddl;


    }


}

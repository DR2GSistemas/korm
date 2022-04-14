<?php


namespace DR2GSistemas\korm\classes;


use PDO;
use ReflectionClass;
use ReflectionException;

/**
 * Constructor de DDL
 * Class DDLBuilder
 * @package DR2GSistemas\korm\classes
 */
class DDLBuilder
{

    private $tables_stmt = [];
    private $tables_delete_stmt = [];

    /**
     * @throws ReflectionException
     */
    public function createTable($className): string
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
                $c->setName($property->getName());
                $stmt = $c->getName() . " " . $c->getType();
                $stmt .= $c->isNullable() ? "" : " NOT NULL";
                $stmt .= $c->isPrimaryKey() ? " PRIMARY KEY" : "";
                $stmt .= $c->isAutoIncrement() ? " AUTO_INCREMENT" : "";

                $columns[] = $stmt;


            }


        }
        $ddl .= " (" . implode(", ", $columns) . ")";

        $this->tables_stmt[] = $ddl;
        $this->tables_delete_stmt[] = "DROP TABLE IF EXISTS " . $entity->getTableName();

        return $ddl;
    }

    /**
     * Crear las tablas
     * @param array $tables Array de clases que se quieren crear
     * @throws ReflectionException
     */
    public function createTables(array $tables): void
    {
        foreach ($tables as $table) {
            $this->createTable($table);
        }
    }

    /**
     * Crear tablas del scheme
     * @param PDO $cn Conexion con base de datos
     */
    public function create_all(PDO $cn)
    {
        foreach ($this->tables_stmt as $stmt) {
            $cn->exec($stmt);
        }
    }

    /**
     * Borrar todas la tablas del scheme
     * @param PDO $cn Conexion con base de datos
     */
    public function drop_all(PDO $cn)
    {
        foreach ($this->tables_delete_stmt as $stmt) {
            $cn->exec($stmt);
        }
    }


}

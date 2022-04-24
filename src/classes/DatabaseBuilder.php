<?php

namespace DR2GSistemas\korm\classes;


use PDO;
use ReflectionClass;
use ReflectionException;

class DatabaseBuilder
{
    public function __construct(public PDO $datasource)
    {

    }

    /**
     * Create a new table with classname
     * @param $classname
     * @throws ReflectionException
     */
    public function createTable(string $classname)
    {
        $tbl = new ReflectionClass($classname);
        $tbl_instance = $tbl->newInstance();
        echo $tbl_instance->_createDDL() . PHP_EOL;
        return $this->datasource->exec($tbl_instance->_createDDL());
    }

    public function createIndex(string $classname): int|false
    {
        $tbl = new ReflectionClass($classname);
        $tbl_instance = $tbl->newInstance();
        $indexes = $tbl_instance->_createIndexesDDL();
        if (!empty($indexes)) {
            foreach ($indexes as $index) {
                echo $index . PHP_EOL;
                $this->datasource->exec($index);
            }
            return count($indexes);
        }
        return false;
    }

    public function createForeignKey(string $classname)
    {
        $tbl = new ReflectionClass($classname);
        $tbl_instance = $tbl->newInstance();
        $indexes = $tbl_instance->_createForeignKeysDDL();
        if (!empty($indexes)) {
            foreach ($indexes as $index) {
                echo $index . PHP_EOL;
                $this->datasource->exec($index);
            }
            return count($indexes);
        }
        return false;
    }


    public function createAllTables(array $classnames): int|false
    {
        $result = 0;
        foreach ($classnames as $classname) {
            $result += $this->createTable($classname);
        }
        return $result;
    }

    public function createAllIndexes(array $classnames): int|false
    {
        $result = 0;
        foreach ($classnames as $classname) {
            $result += $this->createIndex($classname);
        }
        return $result;
    }

    public function createAllForeignKeys(array $classnames): int|false
    {
        $result = 0;
        foreach ($classnames as $classname) {
            $result += $this->createForeignKey($classname);
        }
        return $result;
    }


    public function getExistsTables()
    {
        $tables = [];
        $result = $this->datasource->query("SHOW TABLES");
        while ($row = $result->fetch(PDO::FETCH_NUM)) {
            $tables[] = $row[0];
        }
        return $tables;
    }

    /**
     * Check if table exists
     * @param string $table
     * @return bool
     */
    public function tableExists(string $table)
    {
        $tables = $this->getExistsTables();
        return in_array($table, $tables);
    }

    /**
     * Drop all tables in database
     * @param array $tablenames
     * @return bool
     */
    public function dropAllTables(array $tablenames = [])
    {
        $tables = $this->getExistsTables();
        if (count($tablenames) > 0) {
            $tables = array_intersect($tables, $tablenames);
        }
        foreach ($tables as $table) {
            $this->datasource->exec("DROP TABLE $table");
        }
        return $this->getExistsTables() === 0;
    }

    public function dropAllIndexes(array $tablenames = [])
    {
        $tables = $this->getExistsTables();
        if (count($tablenames) > 0) {
            $tables = array_intersect($tables, $tablenames);
        }
        foreach ($tables as $table) {
            $this->datasource->exec("DROP INDEX $table");
        }
        return $this->getExistsTables() === 0;
    }

    public function dropAllForeingKeys(array $tablenames = [])
    {
        $tables = $this->getExistsTables();
        if (count($tablenames) > 0) {
            $tables = array_intersect($tables, $tablenames);
        }
        foreach ($tables as $table) {
            $this->datasource->exec("ALTER TABLE $table DROP FOREIGN KEY $table");
        }
        return $this->getExistsTables() === 0;
    }


}

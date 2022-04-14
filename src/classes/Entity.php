<?php


namespace DR2GSistemas\korm\classes;


use DR2GSistemas\korm\interfaces\IDDL;
use DR2GSistemas\korm\interfaces\IEntity;
use Exception;
use ReflectionClass;


class Entity implements IEntity, IDDL
{
    /**
     * @var string|null name of table, default is the pluralized class name
     */
    public ?string $tablename = null;
    public bool $checkInsertToUpdate = true;
    /**
     * @var string name of primary key field
     */
    public string $primaryKeyFieldName = "codigo";


    /**
     * Build a select all statement
     * @return string
     */
    public function listaAll()
    {
        $tablename = $this->getTablename();
        return "select * from " . $tablename;
    }

    /**
     * Internal funcion to parse the tablename
     * @return string
     */
    function getTablename(): string
    {
        if (!is_null($this->tablename)) {
            $tblname = $this->tablename;
        } else {
            $p = preg_split("/[\\\]/", strtolower(get_class($this)));
            $clsname = array_pop($p);
            $tblname = self::pluralize($clsname);
            unset ($clsname);
        }

        return $tblname;
    }

    /**
     * Parse when invoque from static call
     * @param $value
     */
    function parseStaticCallTablename($value): void
    {
        $p = preg_split("/[\\\]/", strtolower($value));
        $classname = array_pop($p);
        $tblname = self::pluralize($classname);
        $this->tablename = $tblname;
    }

    /**
     * Internal funcion to parse the primaryKeyFieldName
     * @return string
     */
    function getPrimaryKeyFieldName(): string
    {
        return $this->primaryKeyFieldName ?? 'codigo';
    }

    /**
     * Internal funcion to pluralize
     *
     * @param $singular
     * @param null $plural
     * @return mixed|string
     */
    private static function pluralize($singular, $plural = null)
    {
        if ($plural !== null) return $plural;
        $last_letter = strtolower($singular[strlen($singular) - 1]);
        switch ($last_letter) {
            case 'y':
                return substr($singular, 0, -1) . 'ies';
            case 's':
            case 'd':
            case 'r':
            case 'l':
            case 'n':
                return $singular . 'es';
            case 'o':
            default:
                return $singular . 's';
        }
    }

    public function selectAll()
    {
        $tablename = $this->getTablename();
        $stmt = "select * from $tablename";
        return $stmt;
    }

    public function selectOne($codigo)
    {
        $tablename = $this->getTablename();
        $primaryKeyFieldName = $this->getPrimaryKeyFieldName();
        $stmt = "select * from $tablename where $primaryKeyFieldName=$codigo";
        return $stmt;
    }

    /**
     * Build a insert statement
     * @return string
     */
    public function insert()
    {
        $tablename = $this->getTablename();
        $pkFieldName = $this->getPrimaryKeyFieldName();

        $fields = [];
        $values = [];
        $listFields = get_object_vars($this);

        /*si existe un codigo predefinido, ejecutar update*/
        if ($this->checkInsertToUpdate && array_key_exists($pkFieldName, $listFields) && $listFields[$pkFieldName] != null) {
            return self::update();
        }

        unset($listFields['tablename']); //remove the tablename
        unset($listFields['primaryKeyFieldName']); //remove the primarykeyfieldname
        unset($listFields['checkInsertToUpdate']); //remove check
        foreach ($listFields as $key => $value) {
            array_push($fields, $key);
            array_push($values, $this->parseType($value));
        }
        $_f = join(",", $fields);
        $_v = join(",", $values);
        return "insert into $tablename ($_f) values ($_v)";
    }

    /**
     * Build a update statement
     *
     * @param bool $includeNullValues allow to include null values on statement
     * @return string
     *
     */
    public function update($includeNullValues = true)
    {
        $tablename = $this->getTablename();
        $pkfieldname = $this->getPrimaryKeyFieldName();
        $pkValue = $this->$pkfieldname;
        $props = get_object_vars($this);
        unset($props['tablename']); //remove the tablename
        unset($props['primaryKeyFieldName']); //remove the primarykeyfieldname
        unset($props['checkInsertToUpdate']); //remove check
        $sets = [];
        foreach ($props as $key => $value) {
            if (is_null($value)) {
                if ($includeNullValues) {
                    array_push($sets, "$key=" . $this->parseType($value));
                }
            } else {
                if ($key != $pkfieldname) {
                    array_push($sets, "$key=" . $this->parseType($value));
                }
            }
        }
        $sets = join(",", $sets);
        return "update $tablename set $sets where codigo=" . $pkValue;
    }

    /**
     * Build a delete statement
     * @return string
     */
    public function delete()
    {
        $tablename = $this->getTablename();
        $primaryKeyFieldName = $this->getPrimaryKeyFieldName();
        $value = $this->$primaryKeyFieldName;
        $stmt = "delete from $tablename where $primaryKeyFieldName=$value";
        return $stmt;
    }

    /**
     * Create a object from json data
     * @param $data
     * @return Entity
     * @throws Exception
     */
    public static function fromJson($data)
    {
        if (!isset($data)) {
            throw new Exception("fromJson: Argument is invalid or missing");
        }
        $new_object = new self();
        $new_object->parseStaticCallTablename(get_called_class()); //path candidate for get the right tablename in static constructor
        $new_object->populate($data);
        return $new_object;
    }

    /**
     * Populate the object with attrs
     * @param $data array
     */
    public function populate($data)
    {
        foreach ($data as $attr => $value) {
            /*check especials keys*/
            $is_private_key = strpos($attr, "_") === 0;
            if (is_array($value) || $is_private_key) {
                continue;
            }
            $this->$attr = $value;
        }
    }


    /**
     * Internal function to parse string over other types
     * @param $value
     * @return string
     */
    private function parseType($value)
    {
        if (is_string($value)) {
            return "'" . $value . "'";
        } elseif (is_null($value)) {
            return 'null';
        } else
            return $value;
    }


    /**
     *
     * Select by primaryField value
     *
     * @param $value
     * @return string
     * @throws Exception
     */
    public function findByPrimaryKey($value)
    {
        if (!is_null($value)) {
            throw new Exception("findByPrimaryKey: argument is invalid or missin");
        }
        $tablename = $this->getTablename();
        $primaryKeyFieldName = $this->primaryKeyField;
        $stmt = "select * from $tablename where $primaryKeyFieldName=$value";
        return $stmt;
    }


    public function _createDDL(): string
    {
        $class = new ReflectionClass(get_class($this));
        $entity = $class->newInstance();

        $ddl = "";
        $ddl .= "CREATE TABLE " . $entity->getTableName();

        $columns = [];
        $indexes = []; //todo: implement indexes
        $foreignKeys = []; //todo: implement foreign keys

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

        return $ddl;
    }

    public function _dropDDL(): string
    {
        $class = new ReflectionClass(get_class($this));
        $entity = $class->newInstance();

        $ddl = "";
        $ddl .= "DROP TABLE IF EXISTS " . $entity->getTableName();

        return $ddl;
    }
}

<?php


namespace DR2GSistemas\korm\classes;


use DR2GSistemas\korm\interfaces\IEntity;
use DR2GSistemas\korm\interfaces\IEntityUtils;
use Exception;

class Entity implements IEntity, IEntityUtils
{
    public ?string $tablename = null;

    public function listaAll()
    {
        $tablename = $this->getTablename();
        return "select * from " . $tablename;
    }

    function getTablename(): string
    {
        if (!is_null($this->tablename)) {
            $tablename = $this->tablename;
        } else {
            $p = preg_split("/[\\\]/", strtolower(get_class($this)));
            $classname = array_pop($p);
            $tablename = self::pluralize($classname);
        }
        unset ($classname);
        return $tablename;
    }

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
            default:
                return $singular . 's';
        }
    }

    public function insert($primaryKeyFieldName = "codigo")
    {
        /*si existe un codigo predefinido, ejecutar update*/
//        if ($this->$primaryKeyFieldName) {
//            return self::update();
//        }


        $tablename = $this->getTablename();
        $fields = [];
        $values = [];
        $_fields = get_object_vars($this);
        foreach ($_fields as $key => $value) {
            if ($key != $primaryKeyFieldName) {
                array_push($fields, $key);
                array_push($values, $this->parseType($value));
            }
        }
        $_f = join(",", $fields);
        $_v = join(",", $values);

        return "insert into $tablename ($_f) values ($_v)";
    }

    public function update($primaryKeyColumnName = 'codigo', $includeNullValues = true)
    {
        $tablename = $this->getTablename();
        $props = get_object_vars($this);
        $sets = [];
        foreach ($props as $key => $value) {

            if (is_null($value)) {
                if ($includeNullValues) {
                    array_push($sets, "$key=" . $this->parseType($value));
                }
            } else {
                if ($key != $primaryKeyColumnName) {
                    array_push($sets, "$key=" . $this->parseType($value));
                }
            }
        }
        $sets = join(",", $sets);
        return "update $tablename set $sets where codigo=" . $this->$primaryKeyColumnName;
    }

    public function delete()
    {
        $tablename = $this->getTablename();
        $primaryKeyName = "";
        $value = 0;

        $stmt = "delete from $tablename where $primaryKeyName=$value";
        return $stmt;

//        $tablename = $this->getTablename();
//        return "delete from $tablename where $primaryKeyColumnName = " . $this->$primaryKeyColumnName;
    }

    /**
     * Create a object from json data
     * @param $data
     * @return Entity
     * @throws Exception
     */
    public function fromJson($data)
    {
        if (!isset($data)) {
            throw new Exception("fromJson: Argument is invalid or missing");
        }
        $new_object = new self();
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
            $is_private_key = str_starts_with($attr, "_");
            if (is_array($value) || $is_private_key) {
                continue;
            }
            $this->$attr = $value;
        }
    }

    private function parseType($value)
    {
        if (is_string($value)) {
            return "'" . $value . "'";
        } elseif (is_null($value)) {
            return 'null';
        } else
            return $value;
    }


}

<?php


namespace DR2GSistemas\korm\classes;


use DR2GSistemas\korm\interfaces\IEntity;
use DR2GSistemas\korm\interfaces\IEntityUtils;

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

    public function insert()
    {
        // TODO: Implement insert() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function fromJson($data)
    {
        // TODO: Implement fromJson() method.
    }

    public function populate($data)
    {
        foreach ($data as $attr => $value) {
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
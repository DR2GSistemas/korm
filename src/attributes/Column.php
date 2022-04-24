<?php


namespace DR2GSistemas\korm\attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Column
{
    private string $name;
    private string $type;
    private bool $nullable = true;
    private bool $primaryKey = false;
    private bool $autoincrement = false;


    /**
     * Column constructor.
     * @param string $type tipo del campo
     * @param int $length longitud del campo
     * @param string|null $default
     * @param bool $primarykey si es llave primaria
     * @param bool $autoincrement si es autoincrementable
     * @param bool $nullable si es nulo
     * @param string $onUpdate si se actualiza
     */
    public function __construct(
        string $type = "int",
        int $length = 50,
        ?string $default = null,
        bool $primarykey = false,
        bool $autoincrement = false,
        bool $nullable = true,
        ?string $onUpdate = null)
    {
        $this->type = $type;
        $this->nullable = $nullable;
        $this->primaryKey = $primarykey;
        $this->autoincrement = $autoincrement;
        $this->default = $default;
        $this->length = $length;
        $this->onUpdate = $onUpdate;


        if ($this->type == "string") {
            $this->type = "varchar($length)";
        }

        if ($this->default != null) {
            $this->nullable = false;

        }


    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function isNullable(): bool
    {
        return $this->nullable;
    }

    /**
     * @param bool $nullable
     */
    public function setNullable(bool $nullable): void
    {
        $this->nullable = $nullable;
    }

    /**
     * @return bool
     */
    public function isPrimaryKey(): bool
    {
        return $this->primaryKey;
    }

    /**
     * @param bool $primaryKey
     */
    public function setPrimaryKey(bool $primaryKey): void
    {
        $this->primaryKey = $primaryKey;
    }

    /**
     * @return bool
     */
    public function isAutoincrement(): bool
    {
        return $this->autoincrement;
    }

    /**
     * @param bool $autoincrement
     */
    public function setAutoincrement(bool $autoincrement): void
    {
        $this->autoincrement = $autoincrement;
    }

    /**
     * @return bool
     */
    public function isUnique(): bool
    {
        return $this->unique;
    }

    /**
     * @param bool $unique
     */
    public function setUnique(bool $unique): void
    {
        $this->unique = $unique;
    }

    /**
     * @return bool
     */
    public function isIndex(): bool
    {
        return $this->index;
    }

    /**
     * @param bool $index
     */
    public function setIndex(bool $index): void
    {
        $this->index = $index;
    }


    public function getColumnDDL()
    {
        $ddl = "";
        $ddl .= $this->name . " " . $this->type;
        if ($this->length != null && $this->type == "varchar" && strpos($this->type, "(") === false) {
            $ddl .= "(" . $this->length . ")";
        }
        if ($this->nullable and $this->primaryKey == false) {
            $ddl .= " NULL ";
        } else {
            $ddl .= " NOT NULL";
        }

        if ($this->primaryKey) {
            $ddl .= " PRIMARY KEY";
        }
        if ($this->autoincrement) {
            $ddl .= " AUTO_INCREMENT";
        }

        if ($this->default) {
            $ddl .= " DEFAULT " . $this->default . "";
        }
        if ($this->onUpdate) {
            $ddl .= " ON UPDATE " . $this->onUpdate . "";
        }


        return $ddl;
    }

}

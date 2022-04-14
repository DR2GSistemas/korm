<?php


namespace DR2GSistemas\korm\classes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Column
{
    private string $name;
    private string $type;
    private bool $nullable = true;
    private bool $primaryKey = false;
    private bool $autoincrement = false;
    private bool $unique = false;
    private bool $index = false;


    /**
     * Column constructor.
     * @param string $type tipo del campo
     * @param bool $primarykey si es llave primaria
     * @param bool $autoincrement si es autoincrementable
     * @param bool $nullable si es nulo
     * @param bool $index si es indice
     * @param bool $unique si es unico
     */
    public function __construct(
        string $type = "int",
        bool $primarykey = false,
        bool $autoincrement = false,
        bool $nullable = true,
        bool $index = false,
        bool $unique = false)
    {
        $this->type = $type;
        $this->nullable = $nullable;
        $this->primaryKey = $primarykey;
        $this->autoincrement = $autoincrement;
        $this->index = $index;
        $this->unique = $unique;
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


}

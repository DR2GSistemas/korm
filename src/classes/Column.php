<?php


namespace DR2GSistemas\korm\classes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Column
{
    private string $name;
    private string $type;
    private bool $nullable = false;


    public function __construct(string $name, string $type, bool $notnull = false)
    {
        $this->name = $name;
        $this->type = $type;
        $this->notnull = $notnull;

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


}

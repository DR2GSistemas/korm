<?php


namespace DR2GSistemas\korm\classes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Index
{
    private string $tablename;
    private string $fieldname;


    /**
     * Index constructor.
     * @param string $indexname nombre del indice
     * @param string $sort nombre del campo por el cual se ordena
     * @param bool $unique si el indice es unico
     * @param array $combinedFields campos a combinar para el indice
     */
    public function __construct(public string $indexname,
                                public string $sort = "ASC",
                                public bool $unique = false,
                                public array $combinedFields = [])
    {

    }

    public function toStringCreate(): string
    {
        if ($this->unique) {
            return "ALTER TABLE {$this->tablename} ADD UNIQUE INDEX {$this->indexname} ({$this->fieldname})";
        } else {
            return "ALTER TABLE {$this->tablename} ADD INDEX {$this->indexname} ({$this->fieldname})";
        }


    }

    public function toStringDrop(): string
    {
        return "ALTER TABLE {$this->tablename} DROP INDEX {$this->indexname}";
    }

    /**
     * @return string
     */
    public function getTablename(): string
    {
        return $this->tablename;
    }

    /**
     * @param string $tablename
     */
    public function setTablename(string $tablename): void
    {
        $this->tablename = $tablename;
    }

    /**
     * @return string
     */
    public function getFieldname(): string
    {
        return $this->fieldname;
    }

    /**
     * @param string $fieldname
     */
    public function setFieldname(string $fieldname): void
    {
        $this->fieldname = $fieldname;
    }


}

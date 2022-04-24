<?php


namespace DR2GSistemas\korm\attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class ForeignKey
{
    private string $tablename;
    private string $fieldname;

    /**
     * ForeignKey constructor.
     * @param string $indexname
     * @param string $table
     * @param string $column
     * @param string $onDelete
     * @param string $onUpdate
     */
    public function __construct(public string $indexname,
                                public string $table,
                                public string $column,
                                public string $onDelete = 'RESTRICT',
                                public string $onUpdate = 'RESTRICT')
    {
    }


    public function toStringCreate(): string
    {
        $restricts = "ON DELETE {$this->onDelete} ON UPDATE {$this->onUpdate}";

        return "ALTER TABLE {$this->tablename} ADD CONSTRAINT {$this->indexname} FOREIGN KEY ({$this->fieldname}) REFERENCES {$this->table}($this->column) {$restricts }";
    }

    public function toStringDrop(): string
    {
        return "ALTER TABLE {$this->tablename} DROP FOREIGN KEY {$this->indexname}";
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

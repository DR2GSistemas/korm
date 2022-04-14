<?php


namespace DR2GSistemas\korm\classes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class ForeignKey
{
    private string $tablename;
    private string $fieldname;

    public function __construct(string $indexName, string $table, string $column, string $onDelete = 'RESTRICT', string $onUpdate = 'RESTRICT')

    {
        $this->indexName = $indexName;
        $this->table = $table;
        $this->column = $column;
        $this->onDelete = $onDelete;
        $this->onUpdate = $onUpdate;

    }


    public function toStringCreate(): string
    {
        $restricts = "ON DELETE {$this->onDelete} ON UPDATE {$this->onUpdate}";

        return "ALTER TABLE {$this->tablename} ADD CONSTRAINT {$this->indexName} FOREIGN KEY ({$this->fieldname}) REFERENCES {$this->table}($this->column) {$restricts }";
    }

    public function toStringDrop(): string
    {
        return "ALTER TABLE {$this->tablename} DROP FOREIGN KEY {$this->indexName}";
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

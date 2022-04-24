<?php


namespace DR2GSistemas\korm\classes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
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

    /**
     * Retorna DDL del indice a crear
     * @return string
     */
    public function toStringCreate(): string
    {
        if ($this->unique) {
            return "ALTER TABLE {$this->tablename} ADD UNIQUE INDEX {$this->indexname} ({$this->fieldname} {$this->sort})";
        } else {
            return "ALTER TABLE {$this->tablename} ADD INDEX {$this->indexname} ({$this->fieldname} {$this->sort})";
        }


    }

    /**
     * Retorna DDL para eliminar el indice
     * @return string
     */
    public function toStringDrop(): string
    {
        return "ALTER TABLE {$this->tablename} DROP INDEX {$this->indexname}";
    }

    /**
     * Retorna nombre de la tabla
     * @return string
     */
    public function getTablename(): string
    {
        return $this->tablename;
    }

    /**
     * Establece el nombre de la tabla
     * @param string $tablename
     */
    public function setTablename(string $tablename): void
    {
        $this->tablename = $tablename;
    }

    /**
     * Obtiene el nombre del campo
     * @return string
     */
    public function getFieldname(): string
    {
        return $this->fieldname;
    }

    /**
     * Establece el nombre del campo
     * @param string $fieldname
     */
    public function setFieldname(string $fieldname): void
    {
        $this->fieldname = $fieldname;
    }


}

<?php


namespace DR2GSistemas\korm\classes;


use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Index
{


    public function __construct()
    {

    }

    public function getDDL($table, $fieldname)
    {
        return "CREATE INDEX 'idx_'$fieldname ON $table ($fieldname ASC);";
    }
}

<?php


namespace DR2GSistemas\korm\interfaces;


interface IEntityUtils
{
    public static function fromJson($data);

    public function populate($data);

    function getTablename(): string;

}

<?php


namespace DR2GSistemas\korm\interfaces;


interface IEntityUtils
{
    public function fromJson($data);

    public function populate($data);

    function getTablename(): string;

}
<?php


namespace DR2GSistemas\korm\interfaces;


interface ISelect
{
    public function select(array $fields = []): IWhere;

    public function selectAll();

}

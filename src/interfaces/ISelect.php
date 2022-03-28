<?php


namespace DR2GSistemas\korm\interfaces;


interface ISelect
{
    public function Select(array $fields = []): IWhere;

}

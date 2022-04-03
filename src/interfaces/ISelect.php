<?php


namespace DR2GSistemas\korm\interfaces;


interface ISelect
{
    public function selectOne($codigo): IWhere;

    public function selectAll();

}

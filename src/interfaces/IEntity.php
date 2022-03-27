<?php


namespace DR2GSistemas\korm\interfaces;


interface IEntity
{

    public function listaAll();

    public function insert();

    public function update();

    public function delete();


}
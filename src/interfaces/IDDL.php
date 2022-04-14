<?php


namespace DR2GSistemas\korm\interfaces;


interface IDDL
{
    public function _createDDL(): string;

    public function _dropDDL(): string;
}

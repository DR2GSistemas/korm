<?php


namespace DR2GSistemas\korm\interfaces;


interface IDDL
{
    public function _createDDL(): string;

    public function _dropDDL(): string;

    public function _createIndexesDDL(): string;

    public function _dropIndexesDDL(): string;

    public function _createForeignKeysDDL(): string;

    public function _dropForeignKeysDDL(): string;
}

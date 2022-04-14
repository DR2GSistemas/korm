<?php


namespace DR2GSistemas\korm\interfaces;


interface IDDL
{
    public function _createDDL(): string;

    public function _dropDDL(): string;

    public function _createIndexesDDL(): array;

    public function _dropIndexesDDL(): array;

    public function _createForeignKeysDDL(): array;

    public function _dropForeignKeysDDL(): array;
}

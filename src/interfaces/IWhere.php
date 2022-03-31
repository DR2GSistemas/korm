<?php


namespace DR2GSistemas\korm\interfaces;


interface IWhere
{
    public function where(array $conditionals = []): IJoin|IEntity;

}

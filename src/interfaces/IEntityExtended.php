<?php


namespace DR2GSistemas\korm\interfaces;


interface IEntityExtended
{

    public static function join(IEntity $entity): IEntity;

}

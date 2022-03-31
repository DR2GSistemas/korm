<?php


namespace DR2GSistemas\korm\interfaces;


interface IJoin
{
    public function join(IEntity $entity): IEntity;

    public function innerJoin(IEntity $entity): IEntity;

    public function outterJoin(IEntity $entity): IEntity;

    public function leftJoin(IEntity $entity): IEntity;

    public function rightJoin(IEntity $entity): IEntity;

}

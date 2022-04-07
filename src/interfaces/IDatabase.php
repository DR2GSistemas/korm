<?php


namespace DR2GSistemas\korm\interfaces;


use PDO;

interface IDatabase
{
    public function getInstance(array $params = []): PDO;

}

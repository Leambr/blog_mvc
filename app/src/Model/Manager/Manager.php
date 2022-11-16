<?php

namespace App\Model\Manager;

use App\Model\Interfaces\Database;

abstract class Manager
{
    protected \PDO $pdo;

    public function __construct(Database $database)
    {
        $this->pdo = $database->getMySqlPDO();
    }
}
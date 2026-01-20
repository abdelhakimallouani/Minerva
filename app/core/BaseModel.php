<?php

namespace App\Core;

abstract class BaseModel
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
}

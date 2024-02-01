<?php

namespace App\Model;

class BaseModel
{
    protected $db; // Assuming you have a database connection

    public function __construct($db)
    {
        $this->db = $db;
    }
}

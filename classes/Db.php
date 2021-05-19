<?php

namespace classes;

class Db
{
    private $db;
    private $connection;

    public function __construct()
    {
        $this->db = require_once __DIR__ . '/../dbInfo.php';
        $this->connection =  mysqli_connect($this->db['dbHost'], $this->db['dbUser'], $this->db['dbPass'], $this->db['dbName']);
    }

    public function getConnection()
    {
        return $this->connection;
    }
}

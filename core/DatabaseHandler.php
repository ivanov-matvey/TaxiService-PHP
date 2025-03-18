<?php

namespace core;

use mysqli;

include_once __DIR__ . '/../db_connection.php';

class DatabaseHandler
{
    protected mysqli $connection;

    function __construct()
    {
        $this->connection = new mysqli(hostname, username, password, database);
        if ($this->connection->connect_error) echo $this->connection->connect_error;
    }

    function __destruct()
    {
        $this->connection->close();
    }
}
<?php

namespace controllers;

use core\DatabaseHandler;
use models\Client;

include_once __DIR__ . '/../db_connection.php';
include_once __DIR__ . '/../core/DatabaseHandler.php';
include_once __DIR__ . '/../models/Client.php';

class ClientController extends DatabaseHandler
{
    function GetClients(): array
    {
        $sql = "SELECT * FROM clients";
        $result = $this->connection->query($sql);
        $clients = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $client = new Client($row["id"], $row["name"], $row["birthday"], $row["rate"], $row["user_id"]);
                $clients[] = $client;
            }
            $result->close();
        }
        return $clients;
    }
}
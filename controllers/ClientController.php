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
        $stmt = $this->connection->query($sql);
        $clients = array();
        if ($stmt->num_rows > 0) {
            while ($row = $stmt->fetch_assoc()) {
                $client = new Client($row["id"], $row["name"], $row["birthday"], $row["rate"], $row["user_id"]);
                $clients[] = $client;
            }
            $stmt->close();
        }
        return $clients;
    }

    public function getClient(int $id): ?Client
    {
        $sql = "SELECT * FROM clients WHERE id = $id";
        $stmt = $this->connection->query($sql);
        if ($stmt->num_rows > 0) {
            $row = $stmt->fetch_assoc();
            $client = new Client($row["id"], $row["name"], $row["birthday"], $row["rate"], $row["user_id"]);
            $stmt->close();
            return $client;
        }
        $stmt->close();
        return null;
    }

    public function getClientByUserId(?int $id): ?Client
    {
        if ($id === null) return null;

        $sql = "SELECT * FROM clients WHERE user_id = $id";
        $stmt = $this->connection->query($sql);
        if ($stmt->num_rows > 0) {
            $row = $stmt->fetch_assoc();
            $client = new Client($row["id"], $row["name"], $row["birthday"], $row["rate"], $row["user_id"]);
            $stmt->close();
            return $client;
        }
        $stmt->close();
        return null;
    }
}
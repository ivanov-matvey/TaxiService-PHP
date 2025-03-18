<?php

namespace controllers;

use core\DatabaseHandler;
use models\User;

include_once __DIR__ . '/../db_connection.php';
include_once __DIR__ . '/../core/DatabaseHandler.php';
include_once __DIR__ . '/../models/User.php';

class UserController extends DatabaseHandler
{
    public function getUser(int $id): ?User
    {
        $sql = "SELECT * FROM users WHERE id = $id";
        $stmt = $this->connection->query($sql);
        if ($stmt->num_rows > 0) {
            $row = $stmt->fetch_assoc();
            $user = new User($row["id"], $row["phone"], $row["password_hash"], $row["role"]);
            $stmt->close();
            return $user;
        }
        $stmt->close();
        return null;
    }
}
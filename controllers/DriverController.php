<?php

namespace controllers;

use core\DatabaseHandler;
use models\Driver;

include_once __DIR__ . '/../db_connection.php';
include_once __DIR__ . '/../core/DatabaseHandler.php';
include_once __DIR__ . '/../models/Driver.php';

class DriverController extends DatabaseHandler
{
    function GetDrivers(): array
    {
        $sql = "SELECT * FROM drivers";
        $stmt = $this->connection->query($sql);
        $drivers = array();
        if ($stmt->num_rows > 0) {
            while ($row = $stmt->fetch_assoc()) {
                $driver = new Driver($row["id"], $row["name"], $row["birthday"], $row["rate"], $row["user_id"]);
                $drivers[] = $driver;
            }
            $stmt->close();
        }
        return $drivers;
    }

    public function getDriver(int $id): ?Driver
    {
        $sql = "SELECT * FROM drivers WHERE id = $id";
        $stmt = $this->connection->query($sql);
        if ($stmt->num_rows > 0) {
            $row = $stmt->fetch_assoc();
            $driver = new Driver($row["id"], $row["name"], $row["birthday"], $row["rate"], $row["user_id"]);
            $stmt->close();
            return $driver;
        }
        $stmt->close();
        return null;
    }

    public function getDriverByUserId(?int $id): ?Driver
    {
        if ($id === null) return null;

        $sql = "SELECT * FROM drivers WHERE user_id = $id";
        $stmt = $this->connection->query($sql);
        if ($stmt->num_rows > 0) {
            $row = $stmt->fetch_assoc();
            $driver = new Driver($row["id"], $row["name"], $row["birthday"], $row["rate"], $row["user_id"]);
            $stmt->close();
            return $driver;
        }
        $stmt->close();
        return null;
    }
}
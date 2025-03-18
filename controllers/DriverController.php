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
        $result = $this->connection->query($sql);
        $drivers = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $driver = new Driver($row["id"], $row["name"], $row["birthday"], $row["rate"], $row["user_id"]);
                $drivers[] = $driver;
            }
            $result->close();
        }
        return $drivers;
    }
}
<?php

namespace controllers;

use core\DatabaseHandler;
use models\Car;

include_once __DIR__ . '/../db_connection.php';
include_once __DIR__ . '/../core/DatabaseHandler.php';
include_once __DIR__ . '/../models/Car.php';

class CarController extends DatabaseHandler
{
    function GetCars(): array
    {
        $sql = "SELECT * FROM cars";
        $stmt = $this->connection->query($sql);
        $cars = array();
        if ($stmt->num_rows > 0) {
            while ($row = $stmt->fetch_assoc()) {
                $car = new Car($row["id"], $row["number"], $row["release_year"], $row["baby_seat"]);
                $cars[] = $car;
            }
            $stmt->close();
        }
        return $cars;
    }

    public function getCar(int $id): ?Car
    {
        $sql = "SELECT * FROM cars WHERE id = $id";
        $stmt = $this->connection->query($sql);
        if ($stmt->num_rows > 0) {
            $row = $stmt->fetch_assoc();
            $car = new Car($row["id"], $row["number"], $row["release_year"], $row["baby_seat"]);
            $stmt->close();
            return $car;
        }
        $stmt->close();
        return null;
    }
}
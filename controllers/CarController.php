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

    public function addCar($car): void
    {
        $sql = "INSERT INTO cars (number, release_year, baby_seat) 
                VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $number = $car->getNumber();
        $releaseYear = $car->getReleaseYear();
        $babySeat = $car->hasBabySeat();
        $stmt->bind_param(
            "sii",
            $number,
            $releaseYear,
            $babySeat,
        );
        $stmt->execute();
        $stmt->close();
    }

    public function editCar($car): void
    {
        $sql = "UPDATE cars SET number=?, release_year=?, baby_seat=? WHERE id=?";
        $stmt = $this->connection->prepare($sql);
        $number = $car->getNumber();
        $releaseYear = $car->getReleaseYear();
        $babySeat = $car->hasBabySeat() ?? 0;
        $id = $car->getId();
        $stmt->bind_param(
            "siii",
            $number,
            $releaseYear,
            $babySeat,
            $id
        );
        $stmt->execute();
        $stmt->close();
    }

    public function deleteCar(int $id): void
    {
        $sql = "DELETE FROM cars WHERE id = $id";
        $this->connection->query($sql);
    }
}
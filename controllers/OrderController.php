<?php

namespace controllers;

use core\DatabaseHandler;
use models\Order;

include_once __DIR__ . '/../db_connection.php';
include_once __DIR__ . '/../core/DatabaseHandler.php';
include_once __DIR__ . '/../models/Order.php';

class OrderController extends DatabaseHandler
{
    public function getOrder(int $id): ?Order
    {
        $sql = "SELECT * FROM orders WHERE id = $id";
        $stmt = $this->connection->query($sql);
        if ($stmt->num_rows > 0) {
            $row = $stmt->fetch_assoc();
            $order = new Order(
                $row["id"],
                $row["price"],
                $row["order_datetime"],
                $row["baby"],
                $row["car_id"],
                $row["driver_id"],
                $row["client_id"]
            );
            $stmt->close();
            return $order;
        }
        $stmt->close();
        return null;
    }

    public function getOrdersByUserId(int $userId): array
    {
        $clientQuery = "SELECT id FROM clients WHERE user_id = $userId";
        $clientResult = $this->connection->query($clientQuery);

        if ($clientRow = $clientResult->fetch_assoc()) {
            $clientId = $clientRow["id"];
            return $this->fetchOrders("client_id", $clientId);
        }

        $driverQuery = "SELECT id FROM drivers WHERE user_id = $userId";
        $driverResult = $this->connection->query($driverQuery);

        if ($driverRow = $driverResult->fetch_assoc()) {
            $driverId = $driverRow["id"];
            return $this->fetchOrders("driver_id", $driverId);
        }

        return [];
    }

    public function addOrder(Order $order): void
    {
        $sql = "INSERT INTO orders (price, order_datetime, baby, car_id, driver_id, client_id) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $price = $order->getPrice();
        $datetime = $order->getOrderDatetime();
        $baby = $order->isBaby();
        $carId = $order->getCarId();
        $driverId = $order->getDriverId();
        $clientId = $order->getClientId();
        $stmt->bind_param(
            "dsiiii",
            $price,
        $datetime,
            $baby,
            $carId,
            $driverId,
            $clientId
        );
        $stmt->execute();
        $stmt->close();
    }

    public function editOrder(Order $order): void
    {
        $sql = "UPDATE orders SET price=?, order_datetime=?, baby=?, car_id=?, driver_id=?, client_id=? WHERE id=?";
        $stmt = $this->connection->prepare($sql);
        $orderId = $order->getId();
        $price = $order->getPrice();
        $datetime = $order->getOrderDatetime();
        $baby = $order->isBaby();
        $carId = $order->getCarId();
        $driverId = $order->getDriverId();
        $clientId = $order->getClientId();
        $stmt->bind_param(
            "dsiiiii",
            $price,
            $datetime,
            $baby,
            $carId,
            $driverId,
            $clientId,
            $orderId
        );
        $stmt->execute();
        $stmt->close();
    }

    private function fetchOrders(string $column, int $id): array
    {
        $sql = "SELECT * FROM orders WHERE $column = $id";
        $stmt = $this->connection->query($sql);
        $orders = [];

        if ($stmt->num_rows > 0) {
            while ($row = $stmt->fetch_assoc()) {
                $orders[] = new Order(
                    $row["id"],
                    $row["price"],
                    $row["order_datetime"],
                    $row["baby"],
                    $row["car_id"],
                    $row["driver_id"],
                    $row["client_id"]
                );
            }
            $stmt->close();
        }

        return $orders;
    }
}

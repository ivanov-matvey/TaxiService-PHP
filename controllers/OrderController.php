<?php

namespace controllers;

use core\DatabaseHandler;
use models\Order;

include_once __DIR__ . '/../db_connection.php';
include_once __DIR__ . '/../core/DatabaseHandler.php';
include_once __DIR__ . '/../models/Order.php';

class OrderController extends DatabaseHandler
{
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

    private function fetchOrders(string $column, int $id): array
    {
        $sql = "SELECT * FROM orders WHERE $column = $id";
        $result = $this->connection->query($sql);
        $orders = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
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
            $result->close();
        }

        return $orders;
    }
}

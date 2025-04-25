<?php

namespace controllers;

use core\DatabaseHandler;

include_once __DIR__ . '/../db_connection.php';
include_once __DIR__ . '/../core/DatabaseHandler.php';

class ReportController extends DatabaseHandler
{
    public function getAllOrdersWithDrivers(): array
    {
        $sql = "
            SELECT o.order_datetime, o.price,
                   d.name AS driver_name, d.rate AS driver_rate,
                   c.name AS client_name
            FROM orders o
            JOIN clients c ON o.client_id = c.id
            LEFT JOIN drivers d ON o.driver_id = d.id
            ORDER BY o.order_datetime DESC
        ";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        $orders = [];

        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }

        $stmt->close();
        return $orders;
    }

    public function getAllCarsWithOrders(): array
    {
        $sql = "
            SELECT c.number AS car_number, 
                   o.order_datetime, 
                   o.price, 
                   d.name AS driver_name, 
                   d.rate AS driver_rate
            FROM orders o
            JOIN cars c ON o.car_id = c.id
            LEFT JOIN drivers d ON o.driver_id = d.id
            ORDER BY o.order_datetime DESC
        ";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        $orders = [];

        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }

        $stmt->close();
        return $orders;
    }

    public function getClientsOrderStats(): array
    {
        $sql = "
            SELECT 
                c.name AS client_name,
                AVG(o.price) AS avg_price_last_3_months,
                MAX(CASE WHEN o.baby = 1 THEN 1 ELSE 0 END) AS has_children
            FROM clients c
            LEFT JOIN orders o ON o.client_id = c.id 
                AND o.order_datetime >= DATE_SUB(NOW(), INTERVAL 3 MONTH)
            GROUP BY c.id
        ";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        $clients = [];

        while ($row = $result->fetch_assoc()) {
            $clients[] = $row;
        }

        $stmt->close();
        return $clients;
    }

    public function getChildrenStats(): array
    {
        $sql = "
            SELECT 
                COUNT(DISTINCT c.id) AS total_clients,
                COUNT(DISTINCT CASE WHEN o.baby = 1 THEN c.id ELSE NULL END) AS clients_with_children
            FROM clients c
            LEFT JOIN orders o ON o.client_id = c.id
        ";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        $total = $result['total_clients'];
        $withChildren = $result['clients_with_children'];

        return [
            'total' => $total,
            'with_children' => $withChildren,
            'percent' => $total > 0 ? round($withChildren / $total * 100, 2) : 0
        ];
    }
}
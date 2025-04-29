<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use controllers\OrderController;

require_once __DIR__ . '/../controllers/OrderController.php';

$orderController = new OrderController();

$selectedCarId = $_GET['car_id'] ?? null;
$orders = [];
$avgRating = null;

if ($selectedCarId) {
    $orders = $orderController->getOrdersByCarId((int)$selectedCarId);
    $rates = array_column($orders, 'driver_rate');
    $filtered = array_filter($rates, fn($r) => $r !== null);
    if (count($filtered)) {
        $avgRating = round(array_sum($filtered) / count($filtered), 2);
    }
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("Заказы по автомобилю");

$sheet->fromArray(['Дата и время', 'Цена', 'Водитель', 'Рейтинг']);

$row = 2;
foreach ($orders as $data) {
    $sheet->setCellValue("A{$row}", $data['order_datetime']);
    $sheet->setCellValue("B{$row}", $data['price']);
    $sheet->setCellValue("C{$row}", $data['driver_name'] ?? '—');
    $sheet->setCellValue("D{$row}", $data['driver_rate'] ?? '—');
    $row++;
}

if ($avgRating !== null) {
    $row++;
    $sheet->setCellValue("A{$row}", 'Средний рейтинг водителей');
    $sheet->setCellValue("B{$row}", $avgRating);
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="cars_report.xlsx"');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

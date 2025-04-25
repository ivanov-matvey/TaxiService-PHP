<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

use controllers\OrderController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include_once __DIR__ . "/../controllers/OrderController.php";

$orderController = new OrderController();
$orders = $orderController->getAllOrdersWithDrivers();

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("Отчёт по заказам");

$sheet->fromArray(['Дата', 'Цена', 'Водитель', 'Рейтинг']);

$row = 2;
foreach ($orders as $order) {
    $sheet->setCellValue("A{$row}", $order['order_datetime']);
    $sheet->setCellValue("B{$row}", $order['price']);
    $sheet->setCellValue("C{$row}", $order['driver_name'] ?? '—');
    $sheet->setCellValue("D{$row}", $order['driver_rate'] ?? '—');
    $row++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="orders_report.xlsx"');
$writer = new Xlsx($spreadsheet);
$writer->save("php://output");
exit;

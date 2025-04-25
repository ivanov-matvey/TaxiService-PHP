<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use controllers\ReportController;

include_once __DIR__ . "/../controllers/ReportController.php";

$reportController = new ReportController();
$reportData = $reportController->getAllOrdersWithDrivers();

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("Отчёт по заказам");

$sheet->fromArray(['Дата', 'Цена', 'Водитель', 'Рейтинг']);

$row = 2;
foreach ($reportData as $data) {
    $sheet->setCellValue("A{$row}", $data['order_datetime']);
    $sheet->setCellValue("B{$row}", $data['price']);
    $sheet->setCellValue("C{$row}", $data['driver_name'] ?? '—');
    $sheet->setCellValue("D{$row}", $data['driver_rate'] ?? '—');
    $row++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="orders_report.xlsx"');
$writer = new Xlsx($spreadsheet);
$writer->save("php://output");
exit;

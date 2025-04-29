<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use controllers\ReportController;

require_once __DIR__ . '/../controllers/ReportController.php';

$reportController = new ReportController();
$clientsStats = $reportController->getClientsOrderStats();
$childrenStats = $reportController->getChildrenStats();

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("Статистика клиентов");

$sheet->fromArray(['Имя клиента', 'Средняя цена заказов (3 мес)', 'Есть дети']);

$row = 2;
foreach ($clientsStats as $client) {
    $sheet->setCellValue("A{$row}", $client['client_name']);
    $sheet->setCellValue("B{$row}", round($client['avg_price_last_3_months'] ?? 0, 2));
    $sheet->setCellValue("C{$row}", $client['has_children'] ? 'Да' : 'Нет');
    $row++;
}

$row += 1;
$sheet->setCellValue("A{$row}", 'Всего клиентов');
$sheet->setCellValue("B{$row}", $childrenStats['total']);
$row += 1;
$sheet->setCellValue("A{$row}", 'Клиентов с детьми');
$sheet->setCellValue("B{$row}", $childrenStats['with_children']);
$row += 1;
$sheet->setCellValue("A{$row}", 'Процент клиентов с детьми');
$sheet->setCellValue("B{$row}", $childrenStats['percent'] . '%');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="clients_report.xlsx"');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

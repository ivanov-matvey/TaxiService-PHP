<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use controllers\ReportController;

include_once __DIR__ . "/../controllers/ReportController.php";

$reportController = new ReportController();
$reportData = $reportController->getAllOrdersWithDrivers();

$phpWord = new PhpWord();
$section = $phpWord->addSection();
$section->addTitle("Отчёт по заказам");

$table = $section->addTable();
$table->addRow();
$table->addCell()->addText('Дата');
$table->addCell()->addText('Цена');
$table->addCell()->addText('Водитель');
$table->addCell()->addText('Рейтинг');

foreach ($reportData as $data) {
    $table->addRow();
    $table->addCell()->addText($data['order_datetime']);
    $table->addCell()->addText($data['price']);
    $table->addCell()->addText($data['driver_name'] ?? '—');
    $table->addCell()->addText($data['driver_rate'] ?? '—');
}

header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="orders_report.docx"');

$writer = new Word2007($phpWord);
$writer->save("php://output");
exit;

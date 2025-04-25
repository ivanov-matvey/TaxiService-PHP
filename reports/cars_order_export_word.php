<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
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

$phpWord = new PhpWord();
$section = $phpWord->addSection();
$section->addTitle("Отчёт по заказам");

$table = $section->addTable();
$table->addRow();
$table->addCell()->addText('Дата и время');
$table->addCell()->addText('Цена');
$table->addCell()->addText('Водитель');
$table->addCell()->addText('Рейтинг');

foreach ($orders as $data) {
    $table->addRow();
    $table->addCell()->addText($data['order_datetime']);
    $table->addCell()->addText($data['price']);
    $table->addCell()->addText($data['driver_name'] ?? '—');
    $table->addCell()->addText($data['driver_rate'] ?? '—');
}

if ($avgRating !== null) {
    $section->addTextBreak(1);
    $section->addText("Средний рейтинг водителей: {$avgRating}");
}

header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="cars_report.docx"');
$writer = new Word2007($phpWord);
$writer->save('php://output');
exit;

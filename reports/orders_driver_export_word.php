<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

use controllers\OrderController;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;

include_once __DIR__ . "/../controllers/OrderController.php";

$orderController = new OrderController();
$orders = $orderController->getAllOrdersWithDrivers();

$phpWord = new PhpWord();
$section = $phpWord->addSection();
$section->addTitle("Отчёт по заказам");

$table = $section->addTable();
$table->addRow();
$table->addCell()->addText('Дата');
$table->addCell()->addText('Цена');
$table->addCell()->addText('Водитель');
$table->addCell()->addText('Рейтинг');

foreach ($orders as $order) {
    $table->addRow();
    $table->addCell()->addText($order['order_datetime']);
    $table->addCell()->addText($order['price']);
    $table->addCell()->addText($order['driver_name'] ?? '—');
    $table->addCell()->addText($order['driver_rate'] ?? '—');
}

header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="orders_report.docx"');

$writer = new Word2007($phpWord);
$writer->save("php://output");
exit;

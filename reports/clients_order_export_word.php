<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use controllers\ReportController;

require_once __DIR__ . '/../controllers/ReportController.php';

$reportController = new ReportController();
$clientsStats = $reportController->getClientsOrderStats();
$childrenStats = $reportController->getChildrenStats();

$phpWord = new PhpWord();
$section = $phpWord->addSection();
$section->addTitle("Отчёт по клиентам");

$table = $section->addTable();
$table->addRow();
$table->addCell()->addText('Имя клиента');
$table->addCell()->addText('Средняя цена заказов (3 мес)');
$table->addCell()->addText('Есть дети');

foreach ($clientsStats as $client) {
    $table->addRow();
    $table->addCell()->addText($client['client_name']);
    $table->addCell()->addText(round($client['avg_price_last_3_months'], 2));
    $table->addCell()->addText($client['has_children'] ? 'Да' : 'Нет');
}

$section->addTextBreak(1);
$section->addText("Всего клиентов: " . $childrenStats['total']);
$section->addText("С детьми: " . $childrenStats['with_children']);
$section->addText("Процент клиентов с детьми: " . $childrenStats['percent'] . "%");

header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="clients_report.docx"');

$writer = new Word2007($phpWord);
$writer->save("php://output");
exit;

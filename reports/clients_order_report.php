<?php

session_start();

use controllers\ReportController;

include_once __DIR__ . "/../controllers/ReportController.php";

$userId = $_SESSION['user_id'] ?? null;
$role = $_SESSION['role'] ?? null;

if (!$userId) {
    header("Location: ../");
    exit;
}

$reportController = new ReportController();
$clients = $reportController->getClientsOrderStats();
$childrenStats = $reportController->getChildrenStats();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отчёт: Клиенты</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <header class="border-bottom">
        <div class="container d-flex justify-content-between py-3">
            <ul class="nav nav-pills">
                <?php if ($role == "driver"): ?>
                    <li class="nav-item">
                        <a href="../cars/cars.php" role="button" class="nav-link">Автомобили</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="../orders/orders.php" role="button" class="nav-link">Заказы</a>
                </li>
                <li class="nav-item">
                    <a href="../reports/orders_driver_report.php" role="button" class="nav-link">Отчет 1</a>
                </li>
                <li class="nav-item">
                    <a href="../reports/cars_order_report.php" role="button" class="nav-link">Отчет 2</a>
                </li>
                <li class="nav-item">
                    <a href="../reports/clients_order_report.php" role="button" class="nav-link active">Отчет 3</a>
                </li>
            </ul>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a href="../account/account.php" class="btn btn-outline-primary">Аккаунт</a>
                </li>
                <li class="nav-item ms-2">
                    <a href="../auth/logout.php" class="btn btn-outline-danger">Выйти</a>
                </li>
            </ul>
        </div>
    </header>

    <div class="container mt-4">
        <h2 class="text-center text-primary mb-4">Отчёт: Клиенты</h2>

        <div class="text-center mb-4">
            <a href="clients_order_export_excel.php" class="btn btn-success me-2">Выгрузить в Excel</a>
            <a href="clients_order_export_word.php" class="btn btn-info">Выгрузить в Word</a>
        </div>

        <div class="mb-3">
            <p class="fs-5">Процент клиентов с детьми: <strong><?= $childrenStats['percent'] ?>%</strong></p>
        </div>

        <?php if (empty($clients)): ?>
            <p class="text-muted text-center">Нет данных о клиентах.</p>
        <?php else: ?>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Клиент</th>
                    <th>Средняя цена заказов (посл. 3 мес)</th>
                    <th>Есть дети</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= htmlspecialchars($client['client_name']) ?></td>
                        <td><?= $client['avg_price_last_3_months'] !== null ? round($client['avg_price_last_3_months'], 2) . " ₽" : '—' ?></td>
                        <td><?= $client['has_children'] ? 'Да' : 'Нет' ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

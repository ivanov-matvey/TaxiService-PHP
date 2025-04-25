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
$reportData = $reportController->getAllOrdersWithDrivers();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отчёт: Заказы</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                    <a href="../reports/orders_driver_report.php" role="button" class="nav-link active">Отчет 1</a>
                </li>
                <li class="nav-item">
                    <a href="../reports/cars_order_report.php" role="button" class="nav-link">Отчет 2</a>
                </li>
                <li class="nav-item">
                    <a href="../reports/clients_order_report.php" role="button" class="nav-link">Отчет 3</a>
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
        <h2 class="text-center text-primary mb-4">Отчёт: Заказы</h2>

        <div class="text-center mb-4">
            <a href="orders_driver_export_excel.php" class="btn btn-success me-2">Выгрузить в Excel</a>
            <a href="orders_driver_export_word.php" class="btn btn-info">Выгрузить в Word</a>
        </div>

        <?php if (empty($reportData)): ?>
            <p class="text-muted text-center">Нет заказов.</p>
        <?php else: ?>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Дата и время</th>
                    <th>Цена</th>
                    <th>Водитель</th>
                    <th>Рейтинг</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($reportData as $data): ?>
                    <tr>
                        <td><?= $data['order_datetime'] ?></td>
                        <td><?= $data['price'] ?> ₽</td>
                        <td><?= $data['driver_name'] ?? '—' ?></td>
                        <td><?= $data['driver_rate'] ?? '—' ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

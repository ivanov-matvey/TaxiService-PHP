<?php

session_start();

use controllers\CarController;
use controllers\OrderController;

include_once __DIR__ . "/../controllers/CarController.php";
include_once __DIR__ . "/../controllers/OrderController.php";

$userId = $_SESSION['user_id'] ?? null;
$role = $_SESSION['role'] ?? null;

if (!$userId) {
    header("Location: ../");
    exit;
}

$orderController = new OrderController();

$carController = new CarController();
$cars = $carController->getCars();

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
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отчёт: Автомобили</title>
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
                    <a href="orders_driver_report.php" role="button" class="nav-link">Отчет 1</a>
                </li>
                <li class="nav-item">
                    <a href="cars_order_report.php" role="button" class="nav-link active">Отчет 2</a>
                </li>
                <li class="nav-item">
                    <a href="clients_order_report.php" role="button" class="nav-link">Отчет 3</a>
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
        <h2 class="text-center text-primary mb-4">Отчёт: Заказы по автомобилю</h2>

        <div class="text-center mb-4">
            <a href="cars_order_export_excel.php?car_id=<?= $selectedCarId ?>" class="btn btn-success me-2 <?= empty($selectedCarId) ? 'disabled' : '' ?>">Выгрузить в Excel</a>
            <a href="cars_order_export_word.php?car_id=<?= $selectedCarId ?>" class="btn btn-info <?= empty($selectedCarId) ? 'disabled' : '' ?>">Выгрузить в Word</a>
        </div>

        <form method="get" class="mb-4">
            <div class="row justify-content-center">
                <div class="w-100">
                    <label for="orderCar" class="form-label">Выберите автомобиль</label>
                    <select class="form-select" id="orderCar" name="car_id" onchange="this.form.submit()">
                        <option value="">-- Выберите автомобиль --</option>
                        <?php foreach ($cars as $car): ?>
                            <option value="<?= $car->getId() ?>" <?= $car->getId() == $selectedCarId ? 'selected' : '' ?>>
                                <?= $car->getNumber() ?> (<?= $car->getReleaseYear() ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </form>

        <?php if ($selectedCarId): ?>
            <?php if (empty($orders)): ?>
                <p class="text-muted text-center">Нет заказов по выбранному автомобилю.</p>
            <?php else: ?>
                <p class="text-center"><strong>Средний рейтинг водителей:</strong> <?= $avgRating ?? '—' ?></p>
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
                    <?php foreach ($orders as $data): ?>
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
        <?php endif; ?>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

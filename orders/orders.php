<?php

session_start();

use controllers\OrderController;
use controllers\ClientController;
use controllers\DriverController;

include_once __DIR__ . "/../controllers/OrderController.php";
include_once __DIR__ . "/../controllers/ClientController.php";
include_once __DIR__ . "/../controllers/DriverController.php";

$userId = $_SESSION['user_id'] ?? null;
$role = $_SESSION['role'] ?? null;

if (!$userId) {
    header("Location: ../");
    exit;
}

$orderController = new OrderController();
$clientController = new ClientController();
$driverController = new DriverController();

$orders = $orderController->getOrdersByUserId($userId);

$user = null;
if ($role == "client") {
    $user = $clientController->getClientByUserId($userId);
} else {
    $user = $driverController->getDriverByUserId($userId);
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Заказы</title>
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
                    <a href="../orders/orders.php" role="button" class="nav-link active">Заказы</a>
                </li>
                <li class="nav-item">
                    <a href="../reports/orders_driver_report.php" role="button" class="nav-link">Отчет 1</a>
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

    <h2 class="text-center text-primary mt-4">Мои заказы</h2>
    <h5 class="text-center mb-4"><?= $user->getName() ?></h5>

    <div class="container">
        <div class="w-100 text-center">
            <a role="button" class="btn btn-primary text-center" href="form.php">Новый заказ</a>
        </div>
        <?php if (empty($orders)): ?>
            <p class="text-center text-muted">Нет заказов для этого пользователя.</p>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="row border rounded p-3 mt-2 align-items-center">

                    <div class="col-6 d-flex flex-row p-0 gap-2 align-items-center">
                        <div class="col-3"><h5 class="text-primary m-0"><?= $order->getPrice() ?> ₽</h5></div>
                        <div><h5 class="text-muted m-0"><?= $order->getOrderDatetime() ?></h5></div>
                    </div>

                    <div class="col-6 d-flex flex-row justify-content-end p-0 gap-2">
                        <a role="button" class="btn btn-info" href="content.php?order_id=<?= $order->getId() ?>">Информация</a>
                        <a role="button" class="btn btn-success" href="form.php?order_id=<?= $order->getId() ?>">Изменить</a>
                        <a role="button" class="btn btn-danger" href="delete.php?order_id=<?= $order->getId() ?>">Удалить</a>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

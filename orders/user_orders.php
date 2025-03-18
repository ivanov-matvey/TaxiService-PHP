<?php

use controllers\OrderController;
use controllers\ClientController;
use controllers\DriverController;

include_once __DIR__ . "/../controllers/OrderController.php";
include_once __DIR__ . "/../controllers/ClientController.php";
include_once __DIR__ . "/../controllers/DriverController.php";

$userId = $_GET['user_id'] ?? null;

if (!$userId) {
    header("Location: ../");
    exit;
}

$orderController = new OrderController();
$clientController = new ClientController();
$driverController = new DriverController();

$orders = $orderController->getOrdersByUserId($userId);
$client = $clientController->getClientByUserId($userId);
$driver = $driverController->getDriverByUserId($userId);

$user = null;
if ($client) {
    $user = $client;
} else if ($driver) {
    $user = $driver;
} else {
    header("Location: ../");
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Заказы пользователя</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></head>
</head>
<body>

    <header class="d-flex justify-content-center py-3 border-bottom">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="/" role="button" class="btn btn-secondary">Назад к выбору пользователей</a>
            </li>
        </ul>
    </header>

    <h2 class="text-center text-primary mt-4">Мои заказы</h2>
    <h5 class="text-center mb-4"><?= $user->getName() ?></h5>

    <div class="container" style="max-width:900px">
        <div class="w-100 text-center">
            <a role="button" class="btn btn-primary text-center" href="order_form.php?user_id=<?= $user->getUserId() ?>">Новый заказ</a>
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
                        <a role="button" class="btn btn-info" href="order_content.php?order_id=<?= $order->getId() ?>&user_id=<?= $user->getUserId() ?>">Информация</a>
                        <a role="button" class="btn btn-success" href="order_form.php?order_id=<?= $order->getId() ?>&user_id=<?= $user->getUserId() ?>">Изменить</a>
                        <a role="button" class="btn btn-danger" href="delete_order.php?order_id=<?= $order->getId() ?>&user_id=<?= $user->getUserId() ?>">Удалить</a>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

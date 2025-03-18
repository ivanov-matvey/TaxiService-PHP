<?php

use controllers\OrderController;
use controllers\UserController;
use controllers\CarController;
use controllers\ClientController;
use controllers\DriverController;

include_once __DIR__ . "/../controllers/OrderController.php";
include_once __DIR__ . "/../controllers/UserController.php";
include_once __DIR__ . "/../controllers/CarController.php";
include_once __DIR__ . "/../controllers/ClientController.php";
include_once __DIR__ . "/../controllers/DriverController.php";

$userId = $_GET['user_id'] ?? null;
$orderId = $_GET['order_id'] ?? null;

if (!$userId) {
    header("Location: ../");
    exit;
}

$orderController = new OrderController();
$userController = new UserController();
$carController = new CarController();
$clientController = new ClientController();
$driverController = new DriverController();

$order = $orderController->getOrder($orderId);
$client = $clientController->getClientByUserId($userId) ?? null;
$driver = $driverController->getDriverByUserId($userId) ?? null;

$orderPrice = $order->getPrice();
$orderDatetime = $order->getOrderDatetime();
$orderIsBaby = $order->isBaby() ? "использовалось" : "не использовалось";
if ($client) $driverPhone = $userController->getUser($client->getUserId())->getPhone();
if ($driver) $clientPhone = $userController->getUser($driver->getUserId())->getPhone();
$car = $carController->getCar($order->getCarId());
$carNumber = $car->getNumber();
$carReleaseYear = $car->getReleaseYear();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Контент заказа</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></head>
</head>
<body>

<header class="d-flex justify-content-center py-3 border-bottom">
    <ul class="nav nav-pills">
        <li class="nav-item mx-2"><a href="../" role="button" class="btn btn-secondary">Выбор пользователей</a></li>
        <li class="nav-item mx-2"><a href="user_orders.php?user_id=<?= $userId ?>" role="button" class="btn btn-secondary">Мои заказы</a></li>
    </ul>
</header>

<h2 class="text-center text-primary mt-4 mb-4">Контент заказа</h2>

<div class="container" style="max-width:900px">
    <h5 class="text-center">Стоимость: <?= $orderPrice ?></h5>
    <h5 class="text-center">Дата и время: <?= $orderDatetime ?></h5>
    <h5 class="text-center">Детское кресло: <?= $orderIsBaby ?></h5>
    <?php if($client): ?>
        <h5 class="text-center">Водитель: <?= $driverPhone ?></h5>
    <?php else: ?>
        <h5 class="text-center">Клиент: <?= $clientPhone ?></h5>
    <?php endif;?>
    <h5 class="text-center"><?= $carNumber ?> (<?= $carReleaseYear ?>)</h5>
</div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

<?php

session_start();

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

$userId = $_SESSION['user_id'] ?? null;
$role = $_SESSION['role'] ?? null;
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

$orderPrice = $order->getPrice();
$orderDatetime = $order->getOrderDatetime();
$orderIsBaby = $order->isBaby() ? "использовалось" : "не использовалось";

if ($role == "client") {
    $driverId = $order->getDriverId();
    $agent = $driverController->getDriver($driverId);
} else {
    $clientId = $order->getClientId();
    $agent = $clientController->getClient($clientId);
}
$agentUser = $userController->getUser($agent->getUserId());
$agentPhone = $agentUser->getPhone();

$car = $carController->getCar($order->getCarId());
$carNumber = $car->getNumber();
$carReleaseYear = $car->getReleaseYear();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Информация о заказе</title>
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

    <h2 class="text-center text-primary mt-4 mb-4">Информация о заказе</h2>

    <div class="container">
        <div class="text-center mb-3">
            <h5 class="text-muted">Стоимость: <span class="text-dark"><?= $orderPrice ?> ₽</span></h5>
            <?php if($role == "client"): ?>
                <h5 class="text-muted">Водитель: <span class="text-dark"><?= $agentPhone ?></span></h5>
            <?php else: ?>
                <h5 class="text-muted">Клиент: <span class="text-dark"><?= $agentPhone ?></span></h5>
            <?php endif;?>
            <h5 class="text-muted">Автомобиль: <span class="text-dark"><?= $carNumber ?> (<?= $carReleaseYear ?>)</span></h5>
            <h5 class="text-muted">Дата и время: <span class="text-dark"><?= $orderDatetime ?></span></h5>
            <h5 class="text-muted">Детское кресло: <span class="text-dark"><?= $orderIsBaby ?></span></h5>
        </div>
        <div class="text-center">
            <a role="button" class="btn btn-success text-center" href="form.php?order_id=<?= $orderId ?>">Редактировать</a>
        </div>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

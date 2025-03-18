<?php

use controllers\OrderController;
use controllers\UserController;
use controllers\CarController;
use controllers\ClientController;
use controllers\DriverController;
use models\Order;

include_once __DIR__ . "/../controllers/OrderController.php";
include_once __DIR__ . "/../controllers/UserController.php";
include_once __DIR__ . "/../controllers/CarController.php";
include_once __DIR__ . "/../controllers/ClientController.php";
include_once __DIR__ . "/../controllers/DriverController.php";
include_once __DIR__ . '/../models/Order.php';

$orderId = $_GET['order_id'] ?? null;
$userId = $_GET['user_id'] ?? null;

if (!$userId and !$orderId) {
    header("Location: ../");
    exit;
}

$orderController = new OrderController();
$userController = new UserController();
$carController = new CarController();
$clientController = new ClientController();
$driverController = new DriverController();

$client = $clientController->getClientByUserId($userId) ?? null;
$driver = $driverController->getDriverByUserId($userId) ?? null;

$user = null;
if ($orderId) {
    if ($client) {
        $userId = $client->getUserId();
        $order = $orderController->getOrder($orderId);
    } else {
        $userId = $driver->getUserId();
        $order = $orderController->getOrder($orderId);
    }
} else {
    $user = $userController->getUser($userId);
    $role = $user->getRole();
    if ($client) {
        $order = new Order(NULL, 0, "", 0, 0, 0, $client->getUserId());
    } else {
        $order = new Order(NULL, 0, "", 0, 0, $driver->getId(), 0);
    }
}

$cars = $carController->getCars();
$drivers = $driverController->getDrivers();
$clients = $clientController->getClients();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $price = $_POST['order_price'] ?? null;
    $orderDateTime = $_POST['order_datetime'] ?? null;
    $baby = isset($_POST['order_baby']) ? 1 : 0;
    $carId = $_POST['car_id'] ?? null;
    $driverId = $_POST['driver_id'] ?? null;
    $clientId = $_POST['client_id'] ?? null;

    if ($orderId === null) {
        $order = new Order(NULL, $price, $orderDateTime, $baby, $carId, $driverId, $clientId);
        $orderController->addOrder($order);
    } else {
        $order = new Order($orderId, $price, $orderDateTime, $baby, $carId, $driverId, $clientId);
        $orderController->editOrder($order);
    }
    header("Location: user_orders.php?user_id=$userId");
    exit;
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма заказа</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></head>
</head>
<body>

    <header class="d-flex justify-content-center py-3 border-bottom">
        <ul class="nav nav-pills">
            <li class="nav-item mx-2"><a href="../" role="button" class="btn btn-secondary">Выбор пользователей</a></li>
            <li class="nav-item mx-2"><a href="user_orders.php?user_id=<?= $userId ?>" role="button" class="btn btn-secondary">Мои заказы</a></li>
        </ul>
    </header>

    <h2 class="text-center text-primary mt-4"><?= $orderId ? "Изменить заказ" : "Создать новый заказ" ?></h2>

    <div style="max-width:900px" class="container">
        <form method="post">
            <div class="mb-3">
                <label for="orderPrice" class="form-label">Цена заказа</label>
                <input type="text" class="form-control" id="orderPrice" name="order_price" value="<?= $order->getPrice() ?>" required>
            </div>
            <div class="mb-3">
                <label for="orderDateTime" class="form-label">Дата и время заказа</label>
                <input type="datetime-local" class="form-control" id="orderDateTime" name="order_datetime" value="<?= $order->getOrderDatetime() ?>" required>
            </div>
            <div class="mb-3">
                <label for="orderBaby" class="form-label">Детское кресло</label>
                <input type="checkbox" class="form-check-input" id="orderBaby" name="order_baby" value="1" <?= $order->isBaby() ? 'checked' : '' ?>>
            </div>

            <div class="mb-3">
                <label for="orderCar" class="form-label">Выберите автомобиль</label>
                <select class="form-select" id="orderCar" name="car_id">
                    <option value="">-- Выберите автомобиль --</option>
                    <?php foreach ($cars as $car): ?>
                        <option value="<?= $car->getId() ?>" <?= $car->getId() == $order->getCarId() ? 'selected' : '' ?>>
                            <?= $car->getNumber() ?> (<?= $car->getReleaseYear() ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <?php if (!$client): ?>
                <div class="mb-3">
                    <label for="orderClient" class="form-label">Выберите клиента</label>
                    <select class="form-select" id="orderClient" name="client_id">
                        <option value="">-- Выберите клиента --</option>
                        <?php foreach ($clients as $client): ?>
                            <option value="<?= $client->getId() ?>" <?= $client->getId() == $order->getClientId() ? 'selected' : '' ?>>
                                <?= $userController->getUser($client->getUserId())->getPhone(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php else: ?>
                <input type="hidden" name="client_id" value="<?= $client->getId() ?>">
            <?php endif; ?>

            <?php if (!$driver): ?>
                <div class="mb-3">
                    <label for="orderDriver" class="form-label">Выберите водителя</label>
                    <select class="form-select" id="orderDriver" name="driver_id">
                        <option value="">-- Выберите водителя --</option>
                        <?php foreach ($drivers as $driver): ?>
                            <option value="<?= $driver->getId() ?>" <?= $driver->getId() == $order->getDriverId() ? 'selected' : '' ?>>
                                <?= $userController->getUser($driver->getUserId())->getPhone(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php else: ?>
                <input type="hidden" name="driver_id" value="<?= $driver->getId() ?>">
            <?php endif; ?>

            <div class="mb-3">
                <input type="submit" class="btn btn-success" value="Сохранить">
            </div>
        </form>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

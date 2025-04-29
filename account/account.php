<?php

session_start();

use controllers\UserController;
use controllers\ClientController;
use controllers\DriverController;

include_once __DIR__ . "/../controllers/UserController.php";
include_once __DIR__ . "/../controllers/ClientController.php";
include_once __DIR__ . "/../controllers/DriverController.php";

$userId = $_SESSION['user_id'] ?? null;
$role = $_SESSION['role'] ?? null;

if (!$userId) {
    header("Location: ../");
    exit;
}

$userController = new UserController();
$clientController = new ClientController();
$driverController = new DriverController();

if ($role == "client") {
    $user = $clientController->getClientByUserId($userId);
} else {
    $user = $driverController->getDriverByUserId($userId);
}
$userPhone = $userController->getUser($userId)->getPhone();
$userName = $user->getName();
$userBirthday = $user->getBirthday();
$userRate = $user->getRate();
$userRole = $role == "client" ? "клиент" : "водитель";

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Аккаунт</title>
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
                    <a href="../reports/orders_driver_report.php" role="button" class="nav-link">Отчет 1</a>
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
                    <a href="p" class="btn btn-primary">Аккаунт</a>
                </li>
                <li class="nav-item ms-2">
                    <a href="../auth/logout.php" class="btn btn-outline-danger">Выйти</a>
                </li>
            </ul>
        </div>
    </header>

    <h2 class="text-center text-primary mt-4 mb-4">Аккаунт</h2>

    <div class="container">
        <div class="text-center mb-3">
            <h5 class="text-muted">Имя: <span class="text-dark"><?= $userName ?></span></h5>
            <h5 class="text-muted">Дата рождения: <span class="text-dark"><?= $userBirthday ?></span></h5>
            <h5 class="text-muted">Номер телефона: <span class="text-dark"><?= $userPhone ?></span></h5>
            <h5 class="text-muted">Роль: <span class="text-dark"><?= $userRole ?></span></h5>
            <h5 class="text-muted">Рейтинг: <span class="text-dark"><?= $userRate ?></span></h5>
        </div>
        <div class="d-flex flex-row gap-2 justify-content-center">
            <a role="button" class="btn btn-success text-center" href="form.php">Редактировать</a>
            <a role="button" class="btn btn-danger text-center" href="delete.php">Удалить</a>
        </div>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

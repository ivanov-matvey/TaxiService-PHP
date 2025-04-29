<?php

session_start();

use controllers\CarController;

include_once __DIR__ . "/../controllers/CarController.php";

$carController = new CarController();

$userId = $_SESSION['user_id'] ?? null;
$role = $_SESSION['role'] ?? null;
$carId = $_GET['car_id'] ?? null;

if (!$userId || ($role != "driver")) {
    header("Location: ../");
    exit;
}

$car = $carController->getCar($carId);

$carNumber = $car->getNumber();
$carReleaseYear = $car->getReleaseYear();
$carHasBabySeat = $car->hasBabySeat() ? "есть" : "нет";

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Информация об автомобиле</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <header class="border-bottom">
        <div class="container d-flex justify-content-between py-3">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a href="p" role="button" class="nav-link">Автомобили</a>
                </li>
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
                    <a href="../account/account.php" class="btn btn-outline-primary">Аккаунт</a>
                </li>
                <li class="nav-item ms-2">
                    <a href="../auth/logout.php" class="btn btn-outline-danger">Выйти</a>
                </li>
            </ul>
        </div>
    </header>

    <h2 class="text-center text-primary mt-4 mb-4">Информация об автомобиле</h2>

    <div class="text-center mb-3">
        <h5 class="text-muted">Номер: <span class="text-dark"><?= $carNumber ?></span></h5>
        <h5 class="text-muted">Год выпуска: <span class="text-dark"><?= $carReleaseYear ?></span></h5>
        <h5 class="text-muted">Наличие детского кресла: <span class="text-dark"><?= $carHasBabySeat ?></span></h5>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

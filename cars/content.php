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
$carHasBabySeat = $car->hasBabySeat() ? "Есть" : "Нет";

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
                    <a href="../cars/cars.php" role="button" class="nav-link">Автомобили</a>
                </li>
                <li class="nav-item">
                    <a href="../orders/orders.php" role="button" class="nav-link">Заказы</a>
                </li>
            </ul>
            <a href="../auth/logout.php" class="btn btn-outline-danger">Выйти</a>
        </div>
    </header>

    <h2 class="text-center text-primary mt-4 mb-4">Информация об автомобиле</h2>

    <div class="container" style="max-width:900px">
        <h5 class="text-center">Номер: <?= $carNumber ?></h5>
        <h5 class="text-center">Год выпуска: <?= $carReleaseYear ?></h5>
        <h5 class="text-center">Наличие детского кресла: <?= $carHasBabySeat ?></h5>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

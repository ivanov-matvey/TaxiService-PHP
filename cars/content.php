<?php

use controllers\CarController;

include_once __DIR__ . "/../controllers/CarController.php";

$carId = $_GET['car_id'] ?? null;

$carController = new CarController();

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></head>
</head>
<body>

<header class="d-flex justify-content-center py-3 border-bottom">
    <ul class="nav nav-pills">
        <li class="nav-item mx-2"><a href="../" role="button" class="btn btn-secondary">Выбор пользователей</a></li>
        <li class="nav-item mx-2"><a href="cars.php" role="button" class="btn btn-secondary">Автомобили</a></li>
    </ul>
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

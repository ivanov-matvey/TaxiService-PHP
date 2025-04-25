<?php

session_start();

use controllers\CarController;
use models\Car;

include_once __DIR__ . "/../controllers/CarController.php";
include_once __DIR__ . '/../models/Car.php';

$userId = $_SESSION['user_id'] ?? null;
$role = $_SESSION['role'] ?? null;
$carId = $_GET['car_id'] ?? null;

if (!$userId || ($role != "driver")) {
    header("Location: ../");
    exit;
}

$carController = new CarController();

if ($carId) {
    $car = $carController->getCar($carId);
} else {
    $car = new Car(NULL, "", "", 0);
}

$cars = $carController->getCars();

$carNumber = $car->getNumber();
$carReleaseYear = $car->getReleaseYear();
$carHasBabySeat = $car->hasBabySeat() ? 'checked' : '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $number = $_POST['number'] ?? null;
    $releaseYear = $_POST['release_year'] ?? null;
    $babySeat = isset($_POST['baby_seat']) ?? null;

    if ($carId === null) {
        $car = new Car(NULL, $number, $releaseYear, $babySeat);
        $carController->addCar($car);
    } else {
        $car = new Car($carId, $number, $releaseYear, $babySeat);
        $carController->editCar($car);
    }
    header("Location: cars.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма автомобиля</title>
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

    <h2 class="text-center text-primary mt-4"><?= $carId ? "Изменить информацию об автомобиле" : "Добавить автомобиль" ?></h2>

    <div style="max-width:900px" class="container">
        <form method="post">
            <div class="mb-3">
                <label for="carNumber" class="form-label">Номер</label>
                <input type="text" class="form-control" id="carNumber" name="number" value="<?= $carNumber ?>" placeholder="A000AA" required>
            </div>
            <div class="mb-3">
                <label for="releaseYear" class="form-label">Год выпуска</label>
                <input type="text" class="form-control" id="releaseYear" name="release_year" value="<?= $carReleaseYear ?>" placeholder="1990" required>
            </div>
            <div class="mb-3">
                <label for="babySeat" class="form-label">Наличие детского кресла</label>
                <input type="checkbox" class="form-check-input" id="babySeat" name="baby_seat" value="1" <?= $carHasBabySeat ?>
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-success" value="Сохранить">
            </div>
        </form>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

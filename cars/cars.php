<?php

session_start();

use controllers\CarController;

include_once __DIR__ . "/../controllers/CarController.php";

$carController = new CarController();

$userId = $_SESSION['user_id'] ?? null;
$role = $_SESSION['role'] ?? null;

if (!$userId || ($role != "driver")) {
    header("Location: ../");
    exit;
}

$cars = $carController->getCars();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Автомобили</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <header class="border-bottom">
        <div class="container d-flex justify-content-between py-3">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a href="../orders/orders.php" role="button" class="nav-link active">Автомобили</a>
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

    <h2 class="text-center text-primary mt-4">Автомобили</h2>

    <div class="container" style="max-width:900px">
        <div class="w-100 text-center">
            <a role="button" class="btn btn-primary text-center" href="form.php">Добавить автомобиль</a>
        </div>
        <?php if (empty($cars)): ?>
            <p class="text-center text-muted">Нет автомобилей.</p>
        <?php else: ?>
            <?php foreach ($cars as $car): ?>
                <div class="row border rounded p-3 mt-2 align-items-center">

                    <div class="col-6 d-flex flex-row p-0 gap-2 align-items-center">
                        <div class="col-4"><h5 class="text-primary m-0"><?= $car->getNumber() ?> (<?= $car->getReleaseYear() ?>)</h5></div>
                    </div>

                    <div class="col-6 d-flex flex-row justify-content-end p-0 gap-2">
                        <a role="button" class="btn btn-info" href="content.php?car_id=<?= $car->getId() ?>">Информация</a>
                        <a role="button" class="btn btn-success" href="form.php?car_id=<?= $car->getId() ?>">Изменить</a>
                        <a role="button" class="btn btn-danger" href="delete.php?car_id=<?= $car->getId() ?>">Удалить</a>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

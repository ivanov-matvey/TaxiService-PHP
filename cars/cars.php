<?php

use controllers\CarController;

include_once __DIR__ . "/../controllers/CarController.php";

$carController = new CarController();

$cars = $carController->getCars();


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Автомобили</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></head>
</head>
<body>

    <header class="d-flex justify-content-center py-3 border-bottom">
        <ul class="nav nav-pills">
            <li class="nav-item mx-2"><a href="/" role="button" class="btn btn-secondary">Выбор пользователей</a></li>
            <li class="nav-item mx-2"><a href="/?show=drivers" role="button" class="btn btn-secondary">Заказы</a></li>
        </ul>
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

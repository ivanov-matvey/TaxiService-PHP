<?php

use controllers\CarController;

include_once __DIR__ . "/../controllers/CarController.php";

$carId = $_GET['car_id'] ?? null;

$carController = new CarController();

$car = $carController->getCar($carId);

$carNumber = $car->getNumber();
$carReleaseYear = $car->getReleaseYear();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $carController->deleteCar($carId);
    header("Location: cars.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Удаление автомобиля</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></head>
</head>
<body>

    <header class="d-flex justify-content-center py-3 border-bottom">
        <ul class="nav nav-pills">
            <li class="nav-item mx-2"><a href="../" role="button" class="btn btn-secondary">Выбор пользователей</a></li>
            <li class="nav-item mx-2"><a href="cars.php" role="button" class="btn btn-secondary">Автомобили</a></li>
        </ul>
    </header>

    <h2 class="text-center text-primary mt-4 mb-4">Удаление автомобиля</h2>

    <div class="container" style="max-width:900px">
        <form method="post">
            <div class="mb-3">
                <h5 class="text-center">Вы действительно хотите удалить автомобиль "<?= $carNumber ?> (<?= $carReleaseYear ?>)"?</h5>
            </div>
            <input type="hidden" id="carId" name="car_id" value="<?= $carId ?>">
            <div class="row mb-3 w-100 text-center">
                <div class="col-6"><input type="submit" class="btn btn-danger" value="Удалить"></div>
                <div class="col-6"><a href="cars.php" role="button" class="btn btn-secondary">Не удалять</a></div>
            </div>
        </form>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

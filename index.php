<?php

use controllers\ClientController;
use controllers\DriverController;

include_once __DIR__ . "/controllers/ClientController.php";
include_once __DIR__ . "/controllers/DriverController.php";

$clientController = new ClientController();
$driverController = new DriverController();

$show = $_GET['show'] ?? 'clients';

if ($show === 'clients') {
    $users = $clientController->getClients();
    $title = "Клиенты";
    $switchTo = "drivers";
    $switchLabel = "Показать водителей";
} else {
    $users = $driverController->getDrivers();
    $title = "Водители";
    $switchTo = "clients";
    $switchLabel = "Показать клиентов";
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Выбор пользователя</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></head>
<body>
    <h2 class="text-center text-primary m-4">Выбор <?= $title ?></h2>

    <div class="container" style="max-width:900px">
        <div class="text-center mb-3">
            <a class="btn btn-outline-primary" href="?show=<?= $switchTo ?>"><?= $switchLabel ?></a>
        </div>

        <?php foreach ($users as $user): ?>
            <div class="row border rounded p-3 mt-2 align-items-center">
                <div class="col-5"><h4><?= $user->getName(); ?></h4></div>
                <div class="col-4"><h5><?= $user->getBirthday(); ?></h5></div>
                <div class="col-3">
                    <a role="button" class="btn btn-success" href="orders/user_orders.php?user_id=<?= $user->getUserId() ?>">Выбрать</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

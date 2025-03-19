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

$user = $userController->getUser($userId);
if ($role === "client") {
    $agent = $clientController->getClientByUserId($userId);
} else {
    $agent = $driverController->getDriverByUserId($userId);
}
$phone = $user->getPhone();
$name = $agent->getName();
$birthday = $agent->getBirthday();
$rate = $agent->getRate();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = $_POST['phone'] ?? null;
    $name = $_POST['name'] ?? null;
    $birthday = $_POST['birthday'] ?? null;
    $rate = $_POST['rate'] ?? null;

    $phoneError = "";

    try {
        $userController->editUser($userId, $phone, $name, $birthday, $rate);
    } catch (Exception $error) {
        $phoneError = $error->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма аккаунта</title>
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
                    <a href="../orders/orders.php" role="button" class="nav-link active">Заказы</a>
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

    <h2 class="text-center text-primary mt-4">Изменить информацию об аккаунте</h2>

    <div class="container">
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>" required>
            </div>
            <div class="mb-3">
                <label for="birthday" class="form-label">Дата рождения</label>
                <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $birthday ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Номер телефона</label>
                <input type="text" class="form-control <?= !empty($phoneError) ? 'is-invalid' : '' ?>" id="phone" name="phone" value="<?= $phone ?>" required>
                <?php if (!empty($phoneError)): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($phoneError) ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="rate" class="form-label">Рейтинг</label>
                <input type="number" class="form-control" id="rate" name="rate" value="<?= $rate ?>" min="0" max="5" step="0.1" required>
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-success" value="Сохранить">
            </div>
        </form>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

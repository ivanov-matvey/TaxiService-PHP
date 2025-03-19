<?php

session_start();

use controllers\UserController;

include_once __DIR__ . "/../controllers/UserController.php";

$userController = new UserController();

$userId = $_SESSION['user_id'] ?? null;
$role = $_SESSION['role'] ?? null;

if (!$userId) {
    header("Location: ../");
    exit;
}

$user = $userController->getUser($userId);
$userPhone = $user->getPhone();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController->deleteUser($userId);
    header("Location: ../");
    exit;
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Удаление аккаунта</title>
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

    <h2 class="text-center text-primary mt-4 mb-4">Удаление аккаунта</h2>

    <div class="container" style="max-width:900px">
        <form method="post">
            <div class="mb-3">
                <h5 class="text-center">Вы действительно хотите удалить аккаунт "<?= $userPhone ?>"?</h5>
            </div>
            <input type="hidden" id="$userId" name="$userId" value="<?= $userId ?>">
            <div class="d-flex flex-row gap-2 justify-content-center">
                <input type="submit" class="btn btn-outline-danger" value="Удалить">
                <a href="account.php" role="button" class="btn btn-secondary">Не удалять</a>
            </div>
        </form>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

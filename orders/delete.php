<?php

session_start();

use controllers\OrderController;

include_once __DIR__ . "/../controllers/OrderController.php";

$userId = $_SESSION['user_id'] ?? null;
$role = $_SESSION['role'] ?? null;
$orderId = $_GET['order_id'] ?? null;

if (!$userId) {
    header("Location: ../");
    exit;
}

$orderController = new OrderController();

$order = $orderController->getOrder($orderId);

$orderPrice = $order->getPrice();
$orderDatetime = $order->getOrderDatetime();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderController->deleteOrder($orderId);
    header("Location: orders.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Удаление заказа</title>
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
                    <a href="../orders/orders.php" role="button" class="nav-link">Заказы</a>
                </li>
            </ul>
            <a href="../auth/logout.php" class="btn btn-outline-danger">Выйти</a>
        </div>
    </header>

    <h2 class="text-center text-primary mt-4 mb-4">Удаление заказа</h2>

    <div class="container">
        <form method="post">
            <div class="mb-3">
                <h5 class="text-center">Вы действительно хотите удалить заказ "<?= $orderPrice ?>₽ / <?= $orderDatetime ?>"?</h5>
            </div>
            <input type="hidden" id="orderId" name="order_id" value="<?= $orderId ?>">
            <div class="row mb-3 w-100 text-center">
                <div class="col-6"><input type="submit" class="btn btn-danger" value="Удалить"></div>
                <div class="col-6"><a href="orders.php" role="button" class="btn btn-secondary">Не удалять</a></div>
            </div>
        </form>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

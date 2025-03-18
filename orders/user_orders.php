<?php

use controllers\OrderController;

include_once "../controllers/OrderController.php";

if (!isset($_GET["user_id"])) {
    header("Location: ../");
    exit;
}

$user_id = (int)$_GET["user_id"];
$orderController = new OrderController();
$orders = $orderController->getOrdersByUserId($user_id);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Заказы пользователя</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></head>
</head>
<body>
    <header class="d-flex justify-content-center py-3 border-bottom">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="/" role="button" class="btn btn-secondary">Назад к выбору пользователей</a>
            </li>
        </ul>
    </header>

    <h2 class="text-center text-primary mt-4">Мои заказы</h2>
    <div class="container" style="max-width:900px">
        <?php if (empty($orders)): ?>
            <p class="text-center text-muted">Нет заказов для этого пользователя.</p>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="row border rounded p-3 mt-2 align-items-center">
                    <div class="col-3"><h5 class="text-primary">ID заказа: <?= $order->getId() ?></h5></div>
                    <div class="col-3"><h5 class="text-success"><?= $order->getPrice() ?> ₽</h5></div>
                    <div class="col-3"><h5 class="text-muted"><?= $order->getOrderDatetime() ?></h5></div>
                    <div class="col-3 text-center">
                        <a role="button" class="btn btn-danger" href="delete_order.php?order_id=<?= $order->getId() ?>">Удалить</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

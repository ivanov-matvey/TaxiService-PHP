<?php

session_start();

use controllers\UserController;
use models\User;

include_once __DIR__ . "/../controllers/UserController.php";
include_once __DIR__ . '/../models/User.php';

$show = $_GET["show"] ?? "login";

if (isset($_SESSION['user_id'])) {
    header("Location: ../orders/orders.php");
    exit();
}

$userController = new UserController();

if ($show === "register") {
    $page = "register";
    $title = "Регистрация";
} else {
    $page = "login";
    $title = "Авторизация";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? null;
    $birthday = $_POST['birthday'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $password = $_POST['password'] ?? null;
    $passwordConfirm = $_POST['password_confirm'] ?? null;
    $role = $_POST['role'] ?? null;

    $confirmPasswordError = "";
    $passwordError = "";
    $phoneError = "";

    if (!preg_match('/^8\d{10}$/', $phone)) {
        $phoneError = "Введите номер в формате 89123456789";
    }

    if (isset($passwordConfirm)) {
        if ($password !== $passwordConfirm) {
            $confirmPasswordError = "Пароли не совпадают!";
        }
    }

    if (empty($phoneError) && empty($confirmPasswordError)) {
        if (isset($passwordConfirm)) {
            try {
                $user = new User(NULL, $phone, $password, $role);
                $userController->registerUser($user, $name, $birthday);
            } catch (Exception $error) {
                $phoneError = $error->getMessage();
            }
        } else {
            try {
                $userController->loginUser($phone, $password);
            } catch (Exception $error) {
                $passwordError = $error->getMessage();
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <h2 class="text-center text-primary mt-4"><?= $title ?></h2>

    <div class="container" style="max-width:900px">
        <form method="post">
            <?php if ($page == "register"): ?>
                <div class="mb-3">
                    <label for="name" class="form-label">Имя</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Имя" required>
                </div>
                <div class="mb-3">
                    <label for="birthday" class="form-label">Дата рождения</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" required>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="phone" class="form-label">Номер телефона</label>
                <input type="text" class="form-control <?= !empty($phoneError) ? 'is-invalid' : '' ?>" id="phone" name="phone" placeholder="89998887766" value="<?= htmlspecialchars($phone ?? '') ?>" required>
                <?php if (!empty($phoneError)): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($phoneError) ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control <?= !empty($passwordError) ? 'is-invalid' : '' ?>" id="password" name="password" required>
                <?php if (!empty($passwordError)): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($passwordError) ?></div>
                <?php endif; ?>
            </div>
            <?php if ($page == "register"): ?>
                <div class="mb-3">
                    <label for="passwordConfirm" class="form-label">Подтвердите пароль</label>
                    <input type="password" class="form-control <?= !empty($confirmPasswordError) ? 'is-invalid' : '' ?>" id="passwordConfirm" name="password_confirm" required>
                    <?php if (!empty($confirmPasswordError)): ?>
                        <div class="invalid-feedback"><?= htmlspecialchars($confirmPasswordError) ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Роль</label>
                    <select class="form-select" id="role" name="role">
                        <option value="client" <?= (isset($_POST['role']) && $_POST['role'] == 'client') ? 'selected' : '' ?>>Клиент</option>
                        <option value="driver" <?= (isset($_POST['role']) && $_POST['role'] == 'driver') ? 'selected' : '' ?>>Водитель</option>
                    </select>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <?php if ($page == "login"): ?>
                    <input type="submit" class="btn btn-success" value="Войти">
                <?php else: ?>
                    <input type="submit" class="btn btn-success" value="Зарегистрироваться">
                <?php endif; ?>
            </div>
        </form>

        <?php if ($page == "login"): ?>
            Еще нет аккаунта? <a href="auth.php?show=register">Зарегистрироваться</a>
        <?php else: ?>
            Уже есть аккаунт? <a href="auth.php">Войти</a>
        <?php endif; ?>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

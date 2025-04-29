## Структура БД
![image](https://github.com/user-attachments/assets/99e0bcca-aae5-45fe-8dd5-645649f8279e)

---

## Описание классов на языке PHP

<details><summary>Car.php</summary>
  
  ```php
  <?php
  
  namespace models;
  
  class Car {
      private $id;
      private $number;
      private $releaseYear;
      private $babySeat;
  
      public function __construct($id, $number, $releaseYear, $babySeat)
      {
          $this->id = $id;
          $this->number = $number;
          $this->releaseYear = $releaseYear;
          $this->babySeat = $babySeat;
      }
  
      public function getId() { return $this->id; }
      public function setId($id): void { $this->id = $id; }
  
      public function getNumber() { return $this->number; }
      public function setNumber($number): void { $this->number = $number; }
  
      public function getReleaseYear() { return $this->releaseYear; }
      public function setReleaseYear($releaseYear): void { $this->releaseYear = $releaseYear; }
  
      public function hasBabySeat() { return $this->babySeat; }
      public function setBabySeat($babySeat): void { $this->babySeat = $babySeat; }
  }
  ```

</details>

<details><summary>Client.php</summary>
  
  ```php
  <?php
  
  namespace models;
  
  class Client {
      private $id;
      private $name;
      private $birthday;
      private $rate;
      private $userId;
  
      public function __construct($id, $name, $birthday, $rate, $userId) {
          $this->id = $id;
          $this->name = $name;
          $this->birthday = $birthday;
          $this->rate = $rate;
          $this->userId = $userId;
      }
  
      public function getId() { return $this->id; }
      public function setId($id): void { $this->id = $id; }
  
      public function getName() { return $this->name; }
      public function setName($name): void { $this->name = $name; }
  
      public function getBirthday() { return $this->birthday; }
      public function setBirthday($birthday): void { $this->birthday = $birthday; }
  
      public function getRate() { return $this->rate; }
      public function setRate($rate): void { $this->rate = $rate; }
  
      public function getUserId() { return $this->userId; }
      public function setUserId($userId): void { $this->userId = $userId; }
  }
  ```

</details>

<details><summary>Driver.php</summary>
  
  ```php
  <?php
  
  namespace models;
  
  class Driver {
      private $id;
      private $name;
      private $birthday;
      private $rate;
      private $userId;
  
      public function __construct($id, $name, $birthday, $rate, $userId)
      {
          $this->id = $id;
          $this->name = $name;
          $this->birthday = $birthday;
          $this->rate = $rate;
          $this->userId = $userId;
      }
  
      public function getId() { return $this->id; }
      public function setId($id): void { $this->id = $id; }
  
      public function getName() { return $this->name; }
      public function setName($name): void { $this->name = $name; }
  
      public function getBirthday() { return $this->birthday; }
      public function setBirthday($birthday): void { $this->birthday = $birthday; }
  
      public function getRate() { return $this->rate; }
      public function setRate($rate): void { $this->rate = $rate; }
  
      public function getUserId() { return $this->userId; }
      public function setUserId($userId): void { $this->userId = $userId; }
  }
  ```

</details>

<details><summary>Order.php</summary>
  
  ```php
  <?php
  
  namespace models;
  
  class Order {
      private $id;
      private $price;
      private $orderDatetime;
      private $baby;
      private $carId;
      private $driverId;
      private $clientId;
  
      public function __construct($id, $price, $orderDatetime, $baby, $carId, $driverId, $clientId)
      {
          $this->id = $id;
          $this->price = $price;
          $this->orderDatetime = $orderDatetime;
          $this->baby = $baby;
          $this->carId = $carId;
          $this->driverId = $driverId;
          $this->clientId = $clientId;
      }
  
      public function getId() { return $this->id; }
      public function setId($id): void { $this->id = $id; }
  
      public function getPrice() { return $this->price; }
      public function setPrice($price): void { $this->price = $price; }
  
      public function getOrderDatetime() { return $this->orderDatetime; }
      public function setOrderDatetime($orderDatetime): void { $this->orderDatetime = $orderDatetime; }
  
      public function isBaby() { return $this->baby; }
      public function setBaby($baby): void { $this->baby = $baby; }
  
      public function getCarId() { return $this->carId; }
      public function setCarId($carId): void { $this->carId = $carId; }
  
      public function getDriverId() { return $this->driverId; }
      public function setDriverId($driverId): void { $this->driverId = $driverId; }
  
      public function getClientId() { return $this->clientId; }
      public function setClientId($clientId): void {  $this->clientId = $clientId; }
  }
  ```

</details>

<details><summary>User.php</summary>
  
  ```php
  <?php
  
  namespace models;
  
  class User {
      private $id;
      private $phone;
      private $passwordHash;
      private $role;
  
      public function __construct($id, $phone, $passwordHash, $role)
      {
          $this->id = $id;
          $this->phone = $phone;
          $this->passwordHash = $passwordHash;
          $this->role = $role;
      }
  
      public function getId() { return $this->id; }
      public function setId($id): void { $this->id = $id; }
  
      public function getPhone() { return $this->phone; }
      public function setPhone($phone): void { $this->phone = $phone; }
  
      public function getPasswordHash() { return $this->passwordHash; }
      public function setPasswordHash($passwordHash): void { $this->passwordHash = $passwordHash; }
  
      public function getRole() { return $this->role; }
      public function setRole($role): void { $this->role = $role; }
  }
  ```

</details>

---

## Страницы

<details><summary>Авторизация</summary>
  
  - На этой странице выводится форма авторизации
  - Если пользователь не найден или пароль не верный, пользователь увидит ошибку
  - На странице есть ссылка на регистрацию
  
  ![image](https://github.com/user-attachments/assets/eb41e347-6a75-4bf8-b11e-afe3c474c82a)

</details>

<details><summary>Регистрация</summary>

  - На этой странице выводится форма регистрации
  - Если номер телефона уже занят или пароли не совпадают, пользователь увидит ошибку
  - После регистрации пользователь перенаправляется на страницу входа
  - На странице есть ссылка на вход
  
  ![image](https://github.com/user-attachments/assets/9948783d-d300-4f4d-acbc-3c10be79263a)

</details>

<details><summary>Заказы</summary>

  - На этой странице выводятся все заказы конкретного клиента
  - В зависимости от роли в шапке страницы может быть ссылка на страницу автомобилей
  - Есть кнопка добавления нового заказа
  - Каждый заказ можно изменить удалить или посмотреть информацию

  ##### Роль: клиент
  ![image](https://github.com/user-attachments/assets/67735daf-1e84-4380-9fcb-0897a39c3724)
  ##### Роль: водитель
  ![image](https://github.com/user-attachments/assets/e82c27b3-418e-4ad5-a19c-af3e8784554b)

</details>

<details><summary>Добавление заказа</summary>
  
  - На этой странице выводится форма добавления заказа
  - В поле выбора автомобиля выводятся номер и год выпуска
  - В зависимости от выбранного пользователя отображается поле выбора водителя или клиента
  - В поле выбора водителя/клиента выводится номер

  ##### Роль: клиент
  ![image](https://github.com/user-attachments/assets/41e93fea-aea6-4c0a-bb6b-9423128487da)
  ##### Роль: водитель
  ![image](https://github.com/user-attachments/assets/4fa8a1c5-51b8-437d-a69c-3e3955f04a37)

</details>

<details><summary>Информация о заказе</summary>
  
  - На этой странице выводится информация о конкретном заказе
  
  ![image](https://github.com/user-attachments/assets/c7bd7868-39de-4d31-8c57-b97230b6f245)

</details>

<details><summary>Изменение заказа</summary>
  
  - На этой странице выводится форма изменения заказа
  - При открытии страницы все поля заполняются данными заказа автоматически
  
  ![image](https://github.com/user-attachments/assets/5f90f693-24a4-45ba-b350-899619f65d77)

</details>

<details><summary>Удаление заказа</summary>
  
  - На этой странице пользователь подтверждает удаление заказа
  - После удаления заказа пользователь попадает на страницу со своими заказами
  
  ![image](https://github.com/user-attachments/assets/badc1d4e-88aa-4270-a098-c766bca3e94f)

</details>


<details><summary>Страница с заказами водителя</summary>
  
  - На этой странице выводятся все заказы конкретного водителя
  - В шапке есть кнопка для просмотра автомобилей
  - Есть кнопка добавления нового заказа
  - Каждый заказ можно изменить удалить или посмотреть информацию
  
  ![image](https://github.com/user-attachments/assets/c9b519b3-dbe3-41dc-82a6-c0d720600870)

</details>

<details><summary>Автомобили</summary>
  
  - На этой странице выводятся все автомобили
  - Есть кнопка добавления нового автомобиля
  - Каждый автомобиль можно изменить удалить или посмотреть информацию
  
  ![image](https://github.com/user-attachments/assets/9ef27b84-01e1-46d1-9085-812227ffccc2)

</details>

<details><summary>Добавление автомобиля</summary>
  
  - На этой странице выводится форма добавления автомобиля
  
  ![image](https://github.com/user-attachments/assets/66ad34b8-82f3-4950-a4bc-6dc7a68354e9)

</details>

<details><summary>Информация об автомобиле</summary>
  
  - На этой странице выводится информация о конкретном автомобиле
  
  ![image](https://github.com/user-attachments/assets/6b766385-72c8-41d0-952a-a8e8eb6b8dd1)

</details>

<details><summary>Изменение автомобиля</summary>
  
  - На этой странице выводится форма изменения автомобиля
  - При открытии страницы все поля заполняются данными автомобиля автоматически
  
  ![image](https://github.com/user-attachments/assets/2b247fad-4603-4aee-b61c-a2916bc1a0e3)

</details>

<details><summary>Удаление автомобиля</summary>
  
  - На этой странице пользователь подтверждает удаление автомобиля
  - После удаления автомобиля пользователь попадает на страницу со всеми автомобилями
  
  ![image](https://github.com/user-attachments/assets/bb93c2fe-b74f-4d2a-8f42-0477bce0d94b)

</details>

<details><summary>Аккаунт</summary>
  
  - На этой странице выводится информация о пользователе
  - Есть кнопки редактирования и удаления аккаунта
  
  ![image](https://github.com/user-attachments/assets/0379ac5e-65f4-467b-89fb-01bdad7690d1)

</details>

<details><summary>Изменение аккаунта</summary>
  
  - На этой странице выводится форма изменения данных аккаунта
  - При открытии страницы все поля заполняются данными аккаунта автоматически 
  
  ![image](https://github.com/user-attachments/assets/4fdc94b5-d8ee-497d-826d-3305107c9532)

</details>

<details><summary>Удаление аккаунта</summary>
  
  - На этой странице пользователь подтверждает удаление аккаунта
  - После удаления аккаунта пользователь попадает на страницу авторизации
  
  ![image](https://github.com/user-attachments/assets/40f3bc4f-cfd3-4977-af8c-51ef7f4a4321)

</details>

<details><summary>Выход из аккаунта</summary>
  
  - На этой странице пользователь подтверждает выход из аккаунта
  - После выхода пользователь перенаправляется на страницу авторизации
  
  ![image](https://github.com/user-attachments/assets/dc02080f-dc64-4eb2-8ed2-b9f76c3167d0)

</details>

---

## Обеспечение безопасности веб-приложения

### Доступ пользователей
При входе в систему ID пользователя и его роль заносятся в сессию:
```php
// UserController.php

public function loginUser($phone, $password): void
{
    // ...
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    // ...
}
```

С помощью этих переменных контролируется доступ пользователей на страницах:
```php
// orders.php

<?php

session_start();

$userId = $_SESSION['user_id'] ?? null;
$role = $_SESSION['role'] ?? null;

if (!$userId || ($role != "driver")) {
    header("Location: ../");
    exit;
}
// ...
?>
```

### Валидация полей
При отправке запроса сначала выполняется проверка полей на наличие ошибок. Если ошибки обнаружены, они отображаются пользователю. Запрос на сервер отправляется только при отсутствии ошибок валидации.
```php
// auth.php

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ...
    $phone = $_POST['phone'] ?? null;

    $phoneError = "";

    if (!preg_match('/^8\d{10}$/', $phone)) {
        $phoneError = "Введите номер в формате 89123456789";
    }

    if (empty($phoneError) && empty($confirmPasswordError)) {
        // Дальнейший код выполняется только при отсутствии ошибок
    }
    // ...
}

?>

<div class="mb-3">
    <label for="phone" class="form-label">Номер телефона</label>
    <input type="text" class="form-control <?= !empty($phoneError) ? 'is-invalid' : '' ?>" id="phone" name="phone" placeholder="89998887766" value="<?= htmlspecialchars($phone ?? '') ?>" required>
    <?php if (!empty($phoneError)): ?>
        <div class="invalid-feedback"><?= htmlspecialchars($phoneError) ?></div>
    <?php endif; ?>
</div>
```

### Обработка исключений на сервере
Запросы на сервере обернуты в блок `try-catch`, что позволяет безопасно обрабатывать исключения и предотвращать сбои в случае их возникновения.
```php
// UserController.php

public function registerUser($user, $name, $birthday): void
{
    try {
        // ...
    } catch (Exception $error) {
        $this->connection->rollBack();
        throw $error;
    }
}
```

---

## Быстрый запуск
Создать файл `init.sql`
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    phone VARCHAR(11) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('client', 'driver') NOT NULL
);

CREATE TABLE drivers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    birthday DATE NOT NULL,
    rate DECIMAL(2, 1) DEFAULT 5.0,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    birthday DATE NOT NULL,
    rate DECIMAL(2, 1) DEFAULT 5.0,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    number VARCHAR(10) NOT NULL,
    release_year INT NOT NULL,
    baby_seat BOOLEAN NOT NULL
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    price DECIMAL(9, 2) NOT NULL,
    order_datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
    baby BOOLEAN NOT NULL,
    car_id INT,
    driver_id INT,
    client_id INT,
    FOREIGN KEY (car_id) REFERENCES cars(id) ON DELETE CASCADE,
    FOREIGN KEY (driver_id) REFERENCES drivers(id) ON DELETE CASCADE,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
);
```
Создать файл `docker-compose.yml`
```yaml
services:
  web:
    image: matvenoid/taxi-php:latest
    container_name: taxi-container
    ports:
      - 80:80
    depends_on:
      - db
    networks:
      - taxi-network

  db:
    image: mysql:latest
    container_name: taxi-db-container
    environment:
      - MYSQL_DATABASE=taxi
      - MYSQL_ROOT_PASSWORD=root
    volumes:
      - db:/var/lib/mysql
      - ./init.sql:/docker-entrypoint-initdb.d/init.sql
    networks:
      - taxi-network

  phpmyadmin:
    image: phpmyadmin:latest
    container_name: taxi-phpmyadmin-container
    ports:
      - 8080:80
    environment:
      - PMA_HOST=db
    depends_on:
      - db
    networks:
      - taxi-network

volumes:
  db:
    name: taxi-db-volume

networks:
  taxi-network:
    driver: bridge
    name: taxi-network
```
Выполнить команду:
```bash
docker-compose up -d
```
Сайт доступен по адресу: `http://localhost`
<br>
PhpMyAdmin доступен по адресу: `http://localhost:8080`

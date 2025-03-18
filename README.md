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
      private $user_id;
  
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
      private $user_id;
  
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

<details><summary>Страница с заказами клиента</summary>
  
  - На этой странице выводятся все заказы конкретного клиента
  - Есть кнопка добавления нового заказа
  - Каждый заказ можно изменить удалить или посмотреть информацию
  
  ![image](https://github.com/user-attachments/assets/9cb6cd9b-0c6b-4552-afde-94ac0c59d70b)

</details>

<details><summary>Страница добавления нового заказа</summary>
  
  - На этой странице можно добавить новый заказ
  - В поле выбора автомобиля выводятся номер и год выпуска
  - В зависимости от выбранного пользователя отображается поле выбора водителя или клиента
  - В поле выбора водителя/клиента выводится номер
  
  ![image](https://github.com/user-attachments/assets/dac21209-d6ff-4e2d-9789-d2d2f8328848)

</details>

<details><summary>Страница информации о заказе</summary>
  
  - На этой странице выводится информация о конкретном заказе
  
  ![image](https://github.com/user-attachments/assets/5225ba63-bbcc-4da6-8006-d706be8fd8f9)

</details>

<details><summary>Страница изменения заказа</summary>
  
  - На этой странице можно изменить данные конкретного заказа
  - При открытии страницы все поля заполняются данными заказа автоматически
  
  ![image](https://github.com/user-attachments/assets/53f9d693-e658-45a0-a614-0285ab87a87e)

</details>

<details><summary>Страница удаления заказа</summary>
  
  - На этой странице пользователь подтверждает удаление заказа
  - После удаления заказа пользователь попадает на страницу со своими заказами
  
  ![image](https://github.com/user-attachments/assets/fceb3964-c1fa-45cc-b523-828cad95f0d7)

</details>


<details><summary>Страница с заказами водителя</summary>
  
  - На этой странице выводятся все заказы конкретного водителя
  - В шапке есть кнопка для просмотра автомобилей
  - Есть кнопка добавления нового заказа
  - Каждый заказ можно изменить удалить или посмотреть информацию
  
  ![image](https://github.com/user-attachments/assets/c9b519b3-dbe3-41dc-82a6-c0d720600870)

</details>

<details><summary>Страница с автомобилями</summary>
  
  - На этой странице выводятся все автомобили
  - Есть кнопка добавления нового автомобиля
  - Каждый автомобиль можно изменить удалить или посмотреть информацию
  
  ![image](https://github.com/user-attachments/assets/c19b7d78-14ea-4689-b3cb-c03d00b40e72)

</details>

<details><summary>Страница добавления нового автомобиля</summary>
  
  - На этой странице можно добавить новый автомобиль
  
  ![image](https://github.com/user-attachments/assets/3554a80f-101d-4d48-bda6-4963d5656aa7)

</details>

<details><summary>Страница информации об автомобиле</summary>
  
  - На этой странице выводится информация о конкретном автомобиле
  
  ![image](https://github.com/user-attachments/assets/338e803f-0be4-469f-94e6-246fc4867e7a)

</details>

<details><summary>Страница изменения автомобиля</summary>
  
  - На этой странице можно изменить данные конкретного автомобиля
  - При открытии страницы все поля заполняются данными автомобиля автоматически
  
  ![image](https://github.com/user-attachments/assets/344703fa-a7ff-470e-a9c2-bed791820170)

</details>

<details><summary>Страница удаления автомобиля</summary>
  
  - На этой странице пользователь подтверждает удаление автомобиля
  - После удаления автомобиля пользователь попадает на страницу со всеми автомобилями
  
  ![image](https://github.com/user-attachments/assets/27480231-5dbc-4e70-94aa-cbcd4b3ed5b6)

</details>

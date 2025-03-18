### Структура БД
![image](https://github.com/user-attachments/assets/28e142b2-6a8d-4ad5-9320-b4d318dfa5b5)


### Описание классов на языке PHP

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

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

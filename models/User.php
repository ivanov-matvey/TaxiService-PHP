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
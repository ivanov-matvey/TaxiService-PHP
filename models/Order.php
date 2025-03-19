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
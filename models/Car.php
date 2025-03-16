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

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number): void
    {
        $this->number = $number;
    }

    public function getReleaseYear()
    {
        return $this->releaseYear;
    }

    public function setReleaseYear($releaseYear): void
    {
        $this->releaseYear = $releaseYear;
    }

    public function hasBabySeat()
    {
        return $this->babySeat;
    }

    public function setBabySeat($babySeat): void
    {
        $this->babySeat = $babySeat;
    }
}
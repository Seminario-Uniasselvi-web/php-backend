<?php
class Vehicle {
    private $id;
    private $brand;
    private $description;
    private $color;
    private $registrationPlate;
    private $value;

    public function __construct($id, $brand, $description, $color, $registrationPlate, $value) {
        $this->id = $id;
        $this->brand = $brand;
        $this->description = $description;
        $this->color = $color;
        $this->registrationPlate = $registrationPlate;
        $this->value = $value;
    }

    function getId() {
        return $this->id;
    }

    function getBrand() {
        return $this->brand;
    }

    function getDescription() {
        return $this->description;
    }

    function getColor() {
        return $this->color;
    }

    function getRegistrationPlate() {
        return $this->registrationPlate;
    }

    function getValue() {
        return $this->value;
    }
    
    function setId($id) {
        $this->id = $id;
    }

    function setBrand($brand) {
        $this->brand = $brand;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setColor($color) {
        $this->color = $color;
    }

    function setRegistrationPlate($registrationPlate) {
        $this->registrationPlate = $registrationPlate;
    }

    function setValue($value) {
        $this->value = $value;
    }
}
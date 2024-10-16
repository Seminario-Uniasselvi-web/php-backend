<?php
class Vehicle {
    private $id;
    private $brand;
    private $description;
    private $color;
    private $registrationPlate;
    private $value;
    private $kilometers;
    private $imageUrl;

    public function __construct($brand, $description, $color, $registrationPlate, $value, $kilometers, $imageUrl) {
        $this->brand = $brand;
        $this->description = $description;
        $this->color = $color;
        $this->registrationPlate = $registrationPlate;
        $this->value = $value;
        $this->kilometers = $kilometers;
        $this->imageUrl = $imageUrl;
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

    function getKilometers() {
        return $this->kilometers;
    }

    function getImageUrl() {
        return $this->imageUrl;
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

    function setKilometers($kilometers) {
        $this->kilometers = $kilometers;
    }

    function setImageUrl($imageUrl) {
        $this->imageUrl = $imageUrl;
    }

    function checkFields() {
        foreach ($this as $key => $value) {
            if ($key !== 'id' && empty($value)) {
                return $key;
            }
        }
        return '';
    }
}
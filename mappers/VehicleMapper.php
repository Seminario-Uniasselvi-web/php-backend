<?php

require_once dirname(__DIR__).'\model\Vehicle.php';

class VehicleMapper {
    public static function fromJson($json) {
        $data = json_decode($json, true);

        return new Vehicle(
            $data['brand'] ?? '',
            $data['description'] ?? '',
            $data['color'] ?? '',
            $data['registrationPlate'] ?? '',
            $data['value'] ?? 0.0
        );
    }

    public static function toStdClass(Vehicle $vehicle) {
        $stdClassObject = new stdClass();
        $stdClassObject->id = $vehicle->getId();
        $stdClassObject->brand = $vehicle->getBrand();
        $stdClassObject->description = $vehicle->getDescription();
        $stdClassObject->color = $vehicle->getColor();
        $stdClassObject->registrationPlate = $vehicle->getRegistrationPlate();
        $stdClassObject->value = $vehicle->getValue();

        return $stdClassObject;
    }
}
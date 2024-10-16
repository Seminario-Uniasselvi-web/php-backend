<?php

require_once dirname(__DIR__).'\connection\ConnectionDB.php';
require_once dirname(__DIR__).'\model\Vehicle.php';

class VehicleRepository {

    private PDO $conn;

    public function __construct() {
        $this->conn = ConnectionDB::getInstance();
    }

    public function findAll() {
        $query = $this->conn->query("select * FROM vehicle");
        return $query->fetchAll();
    }

    public function findById(int $id) {
        $query = $this->conn->prepare("select * FROM vehicle WHERE id = :id");
        $query->execute([':id' => $id]);
        $result = $query->fetch();
        return $result ? $result : throw new InvalidArgumentException("Nenhum registro encontrado com o ID informado");
    }

    public function insert(Vehicle $vehicle): Vehicle {
        $query = $this->conn->prepare("INSERT INTO vehicle (brand, description, color, registration_plate, value, kilometers, image_url) 
            VALUES (:brand, :description, :color, :registration_plate, :value, :kilometers, :image_url)");
        
        $queyParams = array(
            ':brand' => $vehicle->getBrand(), 
            ':description' => $vehicle->getDescription(), 
            ':color' => $vehicle->getColor(), 
            ':registration_plate' => $vehicle->getRegistrationPlate(), 
            ':value' => $vehicle->getValue(),
            ':kilometers' => $vehicle->getKilometers(),
            ':image_url' => $vehicle->getImageUrl()
        );

        $query->execute($queyParams);
        $vehicle->setId((int) $this->conn->lastInsertId());

        return $vehicle;
    }

    public function update(Vehicle $vehicle): Vehicle {
        if ($vehicle->getId() === null) {
            throw new InvalidArgumentException("ID do veículo deve ser definido para a atualização.");
        }

        $this->findById($vehicle->getId());

        $query = $this->conn->prepare("
            UPDATE vehicle 
            SET 
                brand = :brand, 
                description = :description, 
                color = :color, 
                registration_plate = :registration_plate, 
                value = :value ,
                kilometers = :kilometers,
                image_url = :image_url 
            WHERE id = :id");
        
        $queyParams = array(
            ':brand' => $vehicle->getBrand(), 
            ':description' => $vehicle->getDescription(), 
            ':color' => $vehicle->getColor(), 
            ':registration_plate' => $vehicle->getRegistrationPlate(), 
            ':value' => $vehicle->getValue(),
            ':kilometers' => $vehicle->getKilometers(),
            ':image_url' => $vehicle->getImageUrl(),
            ':id' => $vehicle->getValue()
        );

        $query->execute($queyParams);
        return $vehicle;
    }

    public function delete(int $id) {
        if ($id === null) {
            throw new InvalidArgumentException("ID do veículo deve ser definido para a exclusão.");
        }

        $stmt = $this->conn->prepare("DELETE FROM vehicle WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}
    
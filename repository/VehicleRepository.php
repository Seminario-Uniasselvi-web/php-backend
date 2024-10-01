<?php

require_once dirname(__DIR__).'\connection\ConnectionDB.php';
require_once dirname(__DIR__).'\model\Vehicle.php';

class VehicleRepository {

    private PDO $conn;

    public function __construct() {
        $this->conn = ConnectionDB::getInstance();
    }

    public function findAll() {
        $query = $this->conn->query("select * FROM veiculo");
        return $query->fetchAll();
    }

    public function findById(int $id) {
        $query = $this->conn->prepare("select * FROM veiculo WHERE id = :id");
        $query->execute([':id' => $id]);
        return $query->fetch();
    }

    public function insert(Vehicle $vehicle): Vehicle {
        $query = $this->conn->prepare("INSERT INTO veiculo (marca, descricao, cor, placa, valor) VALUES (:marca, :descricao, :cor, :placa, :valor)");
        
        $queyParams = array(
            ':marca' => $vehicle->getBrand(), 
            ':descricao' => $vehicle->getDescription(), 
            ':cor' => $vehicle->getColor(), 
            ':placa' => $vehicle->getRegistrationPlate(), 
            ':valor' => $vehicle->getValue()
        );

        $query->execute($queyParams);
        $vehicle->setId((int) $this->conn->lastInsertId());

        return $vehicle;
    }

    public function update(Vehicle $vehicle): Vehicle {
        if ($vehicle->getId() === null) {
            throw new InvalidArgumentException("ID do veículo deve ser definido para a atualização.");
        }

        $query = $this->conn->prepare("UPDATE veiculo SET marca = :marca, descricao = :descricao, cor = :cor, placa = :placa, valor = :valor WHERE id = :id");
        
        $queyParams = array(
            ':marca' => $vehicle->getBrand(), 
            ':descricao' => $vehicle->getDescription(), 
            ':cor' => $vehicle->getColor(), 
            ':placa' => $vehicle->getRegistrationPlate(), 
            ':valor' => $vehicle->getValue(),
            ':id' => $vehicle->getValue()
        );

        $query->execute($queyParams);
        return $vehicle;
    }

    public function delete(int $id) {
        if ($id === null) {
            throw new InvalidArgumentException("ID do veículo deve ser definido para a exclusão.");
        }

        $stmt = $this->conn->prepare("DELETE FROM veiculo WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}
    
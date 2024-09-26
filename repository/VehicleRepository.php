<?php

require_once 'connection\ConnectionDB.php';
require_once 'model\Vehicle.php';

class VehicleRepository {

    private PDO $conn;

    public function __construct() {
        $this->conn = ConnectionDB::getInstance();
    }

    public function findAll() {
        $query = $this->conn->query("select * FROM veiculo");
        return $query->fetchAll();
    }

    public function findById($id) {
        $query = $this->conn->prepare("select * FROM veiculo WHERE id = :id");
        $query->execute([':id' => $id]);
        return $query->fetch();
    }
}
    
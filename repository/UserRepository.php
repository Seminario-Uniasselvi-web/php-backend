<?php

require_once 'connection\ConnectionDB.php';
require_once 'model\User.php';

class UserRepository {

    private PDO $conn;

    public function __construct() {
        $this->conn = ConnectionDB::getInstance();
    }

    public function findAll() {
        $query = $this->conn->query("select * FROM usuario");
        return $query->fetchAll();
    }

    public function findById($id) {
        $query = $this->conn->prepare("select * FROM usuario WHERE id = :id");
        $query->execute([':id' => $id]);
        return $query->fetch();
    }
}
    
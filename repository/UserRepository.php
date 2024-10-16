<?php

require_once dirname(__DIR__).'\connection\ConnectionDB.php';
require_once dirname(__DIR__).'\model\User.php';

class UserRepository {

    private PDO $conn;

    public function __construct() {
        $this->conn = ConnectionDB::getInstance();
    }

    public function findAll() {
        $query = $this->conn->query("select * FROM users");
        return $query->fetchAll();
    }

    public function findById($id) {
        $query = $this->conn->prepare("select * FROM users WHERE id = :id");
        $query->execute([':id' => $id]);
        return $query->fetch();
    }

    public function findByUsername($userName) {
        $query = $this->conn->prepare("select password FROM users WHERE user_name = lower(:userName)");
        $query->execute([':userName' => $userName]);
        return $query->fetch()->senha;
    }
}
    
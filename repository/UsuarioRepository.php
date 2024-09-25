<?php

    require_once 'conexao\Conexao.php';
    require_once 'model\Usuario.php';

class UsuarioRepository {

    private PDO $conn;

    public function __construct() {
        $this->conn = Conexao::getInstance();
    }

    public function findAll() {
        $query = $this->conn->query("select * FROM usuario");
        return $query->fetchAll();
    }
}
    
<?php

    require_once 'conexao\Conexao.php';
    require_once 'model\Veiculo.php';

class VeiculoRepository {

    private PDO $conn;

    public function __construct() {
        $this->conn = Conexao::getInstance();
    }

    public function findAll() {
        $query = $this->conn->query("select * FROM veiculo");
        return $query->fetchAll();
    }
}
    
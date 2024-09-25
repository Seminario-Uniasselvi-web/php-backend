<?php
class Usuario {
    private $id;
    private $userName;
    private $senha;

    public function __construct($id, $userName, $senha) {
        $this->id = $id;
        $this->userName = $userName;
        $this->senha = $senha;
    }

    function getId() {
        return $this->id;
    }

    function getUserName() {
        return $this->userName;
    }

    function getSenha() {
        return $this->senha;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUserName($userName) {
        $this->userName = $userName;
    }

    function setSenha($senha) {
        return $this->senha = $senha;
    }
}
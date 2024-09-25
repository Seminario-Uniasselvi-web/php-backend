<?php
class Veiculo {
    private $id;
    private $marca;
    private $descricao;
    private $cor;
    private $placa;
    private $valor;

    public function __construct($id, $marca, $descricao, $cor, $placa, $valor) {
        $this->id = $id;
        $this->marca = $marca;
        $this->descricao = $descricao;
        $this->cor = $cor;
        $this->placa = $placa;
        $this->valor = $valor;
    }

    function getId() {
        return $this->id;
    }

    function getMarca() {
        return $this->marca;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getCor() {
        return $this->cor;
    }

    function getPlaca() {
        return $this->placa;
    }

    function getValor() {
        return $this->valor;
    }
    
    function setId($id) {
        $this->id = $id;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setCor($cor) {
        $this->cor = $cor;
    }

    function setPlaca($placa) {
        $this->placa = $placa;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }
}
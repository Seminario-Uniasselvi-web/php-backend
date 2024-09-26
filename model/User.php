<?php
class User {
    private $id;
    private $userName;
    private $password;

    public function __construct($id, $userName, $password) {
        $this->id = $id;
        $this->userName = $userName;
        $this->password = $password;
    }

    function getId() {
        return $this->id;
    }

    function getUserName() {
        return $this->userName;
    }

    function getPassword() {
        return $this->password;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUserName($userName) {
        $this->userName = $userName;
    }

    function setPassword($password) {
        return $this->password = $password;
    }
}
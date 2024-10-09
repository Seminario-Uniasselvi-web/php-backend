<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod === 'POST') {
    session_start();
    unset($_SESSION['isLogged']);
} else {
    http_response_code(405);
    echo(json_encode(['error' => 'Método não permitido.']));
}

?>
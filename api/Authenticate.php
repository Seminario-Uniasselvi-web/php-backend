<?php

require_once dirname(__DIR__).'\repository\UserRepository.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod === 'POST') {
    $userInfo = json_decode(file_get_contents('php://input'));
    $userName = $userInfo->userName ?? '';
    $userPassword = $userInfo->password ?? '';

    if (empty($userName) || empty($userPassword)) {
        http_response_code(400);
        echo(json_encode(['error' =>'Parâmetros userName e password faltando']));
        exit;
    }

    $repository = new UserRepository();
    $passWord = $repository->findByUsername($userName);

    if(!isset($passWord) || empty($passWord) || strcmp($passWord, $userPassword)) {
        http_response_code(400);
        echo(json_encode(['error' =>'Usuário ou senha incorretos']));
        exit;
    }

    session_start();
    $_SESSION['isLogged'] = true;
    echo('Sucesso');
    exit;
} else if ($requestMethod === 'GET') {
    session_start();
    if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {
        echo('Logado');
        exit;
    }

    echo('não logado');
    exit;
} else {
    http_response_code(405);
    echo(json_encode(['error' => 'Método não permitido.']));
}


?>
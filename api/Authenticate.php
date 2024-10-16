<?php

require_once dirname(__DIR__).'\repository\UserRepository.php';
require_once dirname(__DIR__).'\auth\Auth.php';

header('Content-Type: application/json');
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod === 'POST') {
    $userInfo = json_decode(file_get_contents('php://input'));
    $token = authenticate($userInfo);

    echo($token);
} else {
    http_response_code(405);
    echo(json_encode(['error' => 'Método não permitido.']));
}



function authenticate($userInfo) {
    $userName = $userInfo->userName ?? '';
    $userPassword = $userInfo->password ?? '';

    if (empty($userName) || empty($userPassword)) {
        http_response_code(400);
        return json_encode(['error' =>'Parâmetros userName e password faltando']);
    }

    $repository = new UserRepository();
    $passWord = $repository->findByUsername($userName);

    if(!isset($passWord) || empty($passWord) || strcmp($passWord, $userPassword)) {
        http_response_code(400);
        return json_encode(['error' =>'Usuário ou senha incorretos']);
    }

    return generateToken($userName);
}

?>
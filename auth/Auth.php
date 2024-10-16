<?php

require_once dirname(__DIR__).'\auth\AuthConfig.php';

function generateToken($username) {
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $payload = json_encode([
        'username' => $username,
        'exp' => time() + JWT_EXPIRATION_TIME
    ]);

    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

    $signature = hash_hmac('sha256', "$base64UrlHeader.$base64UrlPayload", JWT_SECRET_KEY, true);
    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

    return "$base64UrlHeader.$base64UrlPayload.$base64UrlSignature";
}

function verifyToken($headers) {

    if (isset($headers['Authorization'])) {
        $token = str_replace('Bearer ', '', $headers['Authorization']);
    
        list($header, $payload, $signature) = explode('.', $token);
        $validSignature = hash_hmac('sha256', "$header.$payload", JWT_SECRET_KEY, true);
    
        if ($signature === str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($validSignature))) {
            $payloadData = json_decode(base64_decode($payload), true);
            if ($payloadData['exp'] > time()) {
                return true;
            } else {
                http_response_code(401);
                echo json_encode(['error' => 'Token expirado']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['error' => 'Token inválido']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Token não fornecido']);
    }

    return false;
}

?>
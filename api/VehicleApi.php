<?php

require_once dirname(__DIR__).'\repository\VehicleRepository.php';
require_once dirname(__DIR__).'\mappers\VehicleMapper.php';
require_once dirname(__DIR__).'\auth\Auth.php';

header('Content-Type: application/json');

$requestMethod = $_SERVER['REQUEST_METHOD'];
switch ($requestMethod) {
    case 'GET':
        handleGet();
        break;
    case 'POST':
        handlePost();
        break;
    case 'PUT':
        handlePut();
        break;
    case 'DELETE':
        handleDelete();
        break;
    default:
        http_response_code(405);
        echo(json_encode(['error' => 'Método não permitido.']));
        break;
}

function handleGet() {
    $repository = new VehicleRepository();
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        try {
            echo(json_encode($repository->findById($id)));
        } catch(Exception $e) {
            http_response_code(500);
            echo(json_encode(['error' => $e->getMessage()]));
        }
    } else {
        $vehicles = $repository->findAll();
        echo(json_encode($vehicles));
    }
}

function handlePost() {
    checkAuthentication();
    $repository = new VehicleRepository();
    $json = file_get_contents('php://input');
    try {
        $vehicle = VehicleMapper::fromJson($json);
        checkFields($vehicle);
        $insertedVehicle = $repository->insert($vehicle);
        echo(json_encode(VehicleMapper::toStdClass($insertedVehicle)));
    } catch (Exception $e) {
        http_response_code(500);
        echo(json_encode(['error' => $e->getMessage()]));
    }
}

function handlePut() {
    checkAuthentication();
    $repository = new VehicleRepository();
    $json = file_get_contents('php://input');

    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        try {
            $vehicle = VehicleMapper::fromJson($json);
            $vehicle->setId($id);
            checkFields($vehicle);
            $updatedVehicle = $repository->update($vehicle);
            echo(json_encode(VehicleMapper::toStdClass($updatedVehicle)));
        } catch (Exception $e) {
            http_response_code(400);
            echo(json_encode(['error' => $e->getMessage()]));
        }
    } else {
        http_response_code(400);
        echo(json_encode(['error' => 'ID do veículo não especificado.']));
    }
}

function handleDelete() {
    checkAuthentication();
    $repository = new VehicleRepository();
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $repository->delete($id);
    } else {
        http_response_code(400);
        echo(json_encode(['error' => 'ID do veículo não especificado.']));
    }
}

function checkAuthentication() {
    $headers = getallheaders();
    if (!verifyToken($headers)) {
        exit;
    }
}

function checkFields(Vehicle $vehicle) {
    $missingFields = $vehicle->checkFields();
    if (!empty($missingFields)) {
        http_response_code(400);
        echo(json_encode(['error' => 'Campo ' . $missingFields . ' não informado.']));
        exit;
    }
}
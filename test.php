<?php

require 'repository\UserRepository.php';
require 'repository\VehicleRepository.php';


testFindAll();
testFindById();



function testFindAll() {
    echo("Teste findAll <br>");
    $repo = new UserRepository();
    $res = $repo->findAll();

    echo("Users: <br>");
    foreach($res as $r) {
        echo(json_encode($r).'<br>');
    }

    $repo2 = new VehicleRepository();
    $res2 = $repo2->findAll();

    echo("Vehicles: <br>");
    foreach($res2 as $r2) {
        echo(json_encode($r2).'<br>');
    }

    echo("<br>");
    echo("<br>");
}

function testFindById() {
    echo("Teste findById <br>");
    $repo = new UserRepository();
    $res = $repo->findById(1);

    echo("Users: <br>");
    echo(json_encode($res).'<br>');

    $repo2 = new VehicleRepository();
    $res2 = $repo2->findById(1);

    echo("Vehicles: <br>");
    echo(json_encode($res2).'<br>');

    echo("<br>");
    echo("<br>");
}
?>

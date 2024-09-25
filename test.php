<?php

require 'repository\UsuarioRepository.php';
require 'repository\VeiculoRepository.php';

$repo = new UsuarioRepository();

$res = $repo->findAll();

foreach($res as $r) {
    echo json_encode($r);
}

$repo2 = new VeiculoRepository();

$res2 = $repo2->findAll();

foreach($res2 as $r2) {
    echo json_encode($r2);
}

?>

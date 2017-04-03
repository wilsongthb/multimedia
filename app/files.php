<?php
require('app/config.php');
require('app/function.php');

// obtener valores de la peticion
$dir = (isset($_POST['dir'])) ? $_POST['dir'] : $APP_CONFIG['files'];
$filter = (isset($_POST['filter'])) ? $_POST['filter'] : '.mp3';
$inicio = (isset($_POST['inicio'])) ? $_POST['inicio'] : '0';
$cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '10';

$data = my_glob($dir, $filter);
$total = count($data);
$data = array_slice($data, $inicio, $cantidad);

header('Content-Type: application/json');
exit(json_encode([
    'dir' => $dir,
    'data' => $data,
    'total' => $total
]));
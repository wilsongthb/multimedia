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

// echo "<pre>";
$info_data = [];
foreach ($data as $key => $value) {
    $info_data[] = [
        'getid3' => mp3_info($APP_CONFIG['files']."/$value")
    ];
}
header('Content-Type: application/json');
file_put_contents($dir.'/info.json',json_encode(arr_utf8_encode($info_data)));
exit(json_encode([
    'status' => 'revisado papu!'
]));
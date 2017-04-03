<?php
$dir = '.';
$filter = '*.mp3';
if(isset($_GET['dir'])){
    $dir = $_GET['dir'];
}
if(isset($_GET['filter'])){
    $filter = $_GET['filter'];
}

$dir = str_replace('//','/',$dir);

//scandir
$directorios = [];
foreach (scandir($dir) as $key => $value) {
    if(is_dir("$dir/$value")){
        $directorios[] = "?dir=$dir/$value";
    }
}
$musica = glob("$dir/*.mp3");

//responses
$res_dirs_a = [];


$dir_a = '';
foreach (array_filter(explode('/',$dir)) as $key => $value) {
    $dir_a .= "$value/";
    $res_dirs[] = "?dir=$dir_a";
}
$res_dirs = $directorios;
$res_arch = $musica;

exit(json_encode([
    'dirs_a' => $res_dirs_a,
    'dirs' => $res_dirs,
    'arch' => $res_arch
]));
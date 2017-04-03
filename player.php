<?php
if(isset($_GET['carpeta'])){
    // exit($_GET['carpeta']);
    $carpeta = $_GET['carpeta'];
    $carpetas = [];
    foreach (scandir($carpeta) as $key => $value) {
        if(is_dir($carpeta.'/'.$value)){
            $carpetas[] = $value;
        }
    }
    exit(json_encode([
        'data' => $carpetas
    ]));
}
if(isset($_GET['archivos'])){
    // exit($_GET['carpeta']);
    $carpeta = $_GET['archivos'];
    $carpetas = [];
    foreach (scandir($carpeta) as $key => $value) {
        if(!is_dir($carpeta.'/'.$value)){
            $carpetas[] = $value;
        }
    }
    exit(json_encode([
        'data' => $carpetas
    ]));
}
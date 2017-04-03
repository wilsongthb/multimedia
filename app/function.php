<?php
function my_glob($dir, $filter){
    /*
    Lista los archivos por filtro
    omite a los directorios    
    */
    $dirs = [];
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if(!is_dir("$dir/$file")){
                    if(strripos($file, $filter)){
                        $dirs[] = $file;
                    }
                }
            }
            closedir($dh);
        }
    }
    return $dirs;
}
function r_guardar_imagen(&$arr, &$imagenes, $name_img, $solo_una){
    /*
        Explora recursivamente el array en busca de imagenes y las guarda en la carpeta img
    */
    foreach ($arr as $key => &$value) {
        if(gettype($value) == 'array'){
            r_guardar_imagen($value, $imagenes, $name_img, $solo_una);
        }
        if($key == 'data' && isset($arr['image_mime'])){
            $tipo = explode('/',$arr['image_mime'])[1];
            if($solo_una){
                $nombre = $name_img.".$tipo";
            }else{
                $img_count = count($imagenes);
                $nombre = "$img_count - $name_img.$tipo";
            }
            require('app/config.php');
            $file_name = $APP_CONFIG['files'].'/.img/'.$nombre;
            file_put_contents($file_name, $arr['data']);
            $imagenes[] = $file_name;
            $arr['data'] = $file_name; // data ahora guarda la direccion de la imagen
        }
    }
}
function guardar_imagen(&$arr, $name_img, $solo_una = true){
    $imagenes = [];
    r_guardar_imagen($arr, $imagenes, $name_img, $solo_una);
    return $imagenes;
}
function mp3_info($ruta){
    require_once('getID3/getID3/getid3.php');
    $PageEncoding = 'UTF-8';
    $getID3 = new getID3;
    $getID3->setOption(array('encoding' => $PageEncoding));
    $ThisFileInfo = $getID3->analyze($ruta);
    $imagenes = guardar_imagen($ThisFileInfo, 'img'.$ThisFileInfo['filename'], false);
    
    return [
        'info' => $ThisFileInfo,
        'img' => $imagenes
    ];
}

function arr_utf8_encode($arr){
    $new_arr = [];
    foreach ($arr as $key => $value) {
        if(gettype($value) == 'array'){
            $new_arr[utf8_encode($key)] = arr_utf8_encode($value);
        }else $new_arr[utf8_encode($key)] = utf8_encode($value);
    }
    return $new_arr;
}
function ini_get_valor($arr, $clave, &$valor){
    foreach ($arr as $key => $value) {
        if($key === $clave){
            $valor = $value;
            return 1;
        }else{
            if(gettype($value) == 'array'){
                if(ini_get_valor($value, $clave, $valor) == '1'){
                    return 1;
                }
            }
        }
    }
}
function get_valor($arr, $clave){
    foreach ($arr as $key => $value) {
        if($key === $clave){
            return $value;
        }else{
            if(gettype($value) == 'array'){
                $ret = get_valor($value, $clave);
                if($ret != -1){
                    // echo $key."==>".print_r($value,true)."\n";
                    return $ret;
                }
            }
        }
    }
    return -1;
}
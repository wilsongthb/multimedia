<?php
require('app/config.php');
require('app/function.php');

$filename = (isset($_POST['filename'])) ? $_POST['filename'] : '';

$info = mp3_info($filename);

$fileinfo = $info['info'];

$artista = get_valor($fileinfo, 'artist');
$genero = get_valor($fileinfo, 'genre');
$titulo = get_valor($fileinfo, 'title');
$album = get_valor($fileinfo, 'album');

$id3v2 = get_valor($fileinfo, 'id3v2');

exit(
    json_encode(
        arr_utf8_encode(
            [
                'artista' => $artista,
                'genero' => $genero,
                'titulo' => $titulo,
                'album' => $album,
                'img' => $info['img'],
                'ruta' => $filename
            ]

        )

    )

);
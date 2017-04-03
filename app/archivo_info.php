<?php
require_once('../getID3/getID3/getid3.php');

function str_arr(&$arr){
    foreach ($arr as $key => &$value) {
        if(gettype($value) == 'array'){
            str_arr($value);
        }
        if($key == 'data' && isset($arr['image_mime'])){
            $img_mime = $arr['image_mime'];
            $img_data = base64_encode($arr['data']);
            $value = <<<EOD
<img src="data:$img_mime;base64,$img_data">
EOD;
        }
    }
}

$PageEncoding = 'UTF-8';
$getID3 = new getID3;
$getID3->setOption(array('encoding' => $PageEncoding));

$filename = (isset($_POST['filename'])) ? $_POST['filename'] : '../files/NCM_JustinBieber-Company_273885040.mp3';

$ThisFileInfo = $getID3->analyze($filename);
// $img_mime = $ThisFileInfo['comments']['picture'][0]['image_mime'];
// $img_data = base64_encode($ThisFileInfo['comments']['picture'][0]['data']);
// $img = <<<EOD
// <img src="data:$img_mime;base64,$img_data">
// EOD;
// $ThisFileInfo['comments']['picture'][0]['data'] = $img;

str_arr($ThisFileInfo);
$comments = print_r($ThisFileInfo, true);


$response =  <<<EOD
<meta charset="utf-8">
<audio controls>
    <source src="$filename" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
<pre>
COMM:
$comments
EOD;

echo $response;
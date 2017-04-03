<?php
$dir = '.';
if(isset($_GET['dir'])){
    $dir = $_GET['dir'];
}

$dir = str_replace('//','/',$dir);

//scandir
$directorios = [];
foreach (scandir($dir) as $key => $value) {
    if(is_dir("$dir/$value")){
        $directorios[] = <<<EOD
<a href="?dir=$dir/$value">$value</a>
EOD;
    }
}
$musica = glob("$dir/*.mp3");

$response = "<pre>";
$dir_a = '';
foreach (array_filter(explode('/',$dir)) as $key => $value) {
    $dir_a .= "$value/";
    $response .= <<<EOD
<a href="?dir=$dir_a">$value</a>/
EOD;
}
$response .= "\n";
$response .= print_r($directorios,true);
$response .= print_r($musica, true);

exit($response);

//glob filter
// foreach (glob("*.*") as $filename) {
//     echo "glob: $filename\n";
// }

//with is dir
// if (is_dir($dir)) {
//     if ($dh = opendir($dir)) {
//         while (($file = readdir($dh)) !== false) {
//             echo "opendir: $file\n";
//         }
//         closedir($dh);
//     }
// }
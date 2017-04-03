<?php
if($_GET['req'] == 'files'){
    require('app/files.php');
    exit();
}
if($_GET['req'] == 'fileinfo'){
    require('app/file_info.php');
    exit();
}
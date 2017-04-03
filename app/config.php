<?php
$APP_CONFIG = [
    'files' => 'files',
    'host' => $_SERVER['HTTP_HOST'],
    'uri' => $_SERVER['REQUEST_URI'],
    
];

$APP_CONFIG['url'] = $APP_CONFIG['host'].$APP_CONFIG['uri'];
$APP_CONFIG['url_files'] = $APP_CONFIG['url'].$APP_CONFIG['files'];
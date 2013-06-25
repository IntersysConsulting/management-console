<?php

header('Content-Type: text/javascript; charset=UTF-8');
require '../config.php'; 
$content = 'var server = "' . SERVER . '";';
echo $content;
?>


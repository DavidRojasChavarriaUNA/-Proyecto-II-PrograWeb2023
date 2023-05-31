<?php
require('./controllers/cors.php');
/*
//Habilitar cuando da error de cors
$data = json_decode(file_get_contents("php://input"));

http_response_code(200); 
echo json_encode($data);
//fin
*/

//porterior a la ejecución si ya no da error, restaurar el código


//documentar cuando da error de cors
error_reporting(E_ALL);
ini_set('display_errors',0);
//habilitar para ver errores
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//ini_set('memory_limit', '-1');
//echo ini_get('memory_limit');

session_start();
require('PHPFramex.php');
require('routes.php');
//fin
?>
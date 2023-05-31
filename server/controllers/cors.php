<?php
/*header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Authorization, Cache-Control, Access-Control-Allow-Headers, Origin, Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");
header('Access-Control-Allow-Methods: GET, HEAD, PUT, PATCH, POST, DELETE');*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

?>
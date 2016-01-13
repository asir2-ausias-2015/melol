<?php

/* 
* Fichero de conexión a la base de datos
* Toma los valores del fichero config.php
*/

include 'config.php';
$conexion = new mysqli($host, $username, $password, $db_name);
if ($conexion->connect_errno) { // Si se produce algún error finaliza con mensaje de error
die("Error de Conexión: " . $conexion->connect_error);
}
$conexion->set_charset("utf8");




<?php

/* 
* Fichero de conexión a la base de datos
* Toma los valores del fichero config.php 
*/

require './config.local.php';
$conexion = new mysqli($config['dbHost'], $config['dbUser'], $config['dbPass'], $config['dbName']);
if ($conexion->connect_errno) { // Si se produce algún error finaliza con mensaje de error
die("Error de Conexión: ". $conexion->connect_error);
}
$conexion->set_charset("utf8");


  
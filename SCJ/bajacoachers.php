<?php
//declaracion de variables
session_name(MELOLSESSION);
session_start();
$_SESSION[coachId];
include 'config.php';
//crear una conexion a la base de datos
$conexion = new mysqli(localhost, '$phpuser', '$phppass', melol);
//comprobamos si hemos tenido exito
if($conexion->connect_errno){
    die("Error al conectarnos a la base de datos: ".$conexion->connect_errno);
}


$conex->autocommit(false);

try {
    $conex->query("DELETE FROM `melol`.`bids` "
            . "WHERE `coachId` = $_SESSION[coachId]");
    $conex->query("");
    $conex->query("");
    $conex->query("");
    $conex->query("DELETE FROM `melol`.`coaches` "
        . "WHERE `coachId` = $_SESSION[coachId]");
    $conex->commit();
    ;
} catch (Exception $e) {
    $conex->rollback();
    echo 'Something fails: ',  $e->getMessage(), "\n";
}

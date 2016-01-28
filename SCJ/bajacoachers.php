<?php
//declaracion de variables
session_name(MELOLSESSION);
session_start();
$_SESSION[coachId];
include 'config.php';
//crear una conexion a la base de datos
$conex = new mysqli(localhost, '$phpuser', '$phppass', melol);
//comprobamos si hemos tenido exito
if($conex->connect_errno){
    die("Error al conectarnos a la base de datos: ".$conexion->connect_errno);
}

$MIGRA1=$conex->query("SELECT participationId, leagueId FROM participation"
        . "WHERE `coachId` = $_SESSION[coachId]");
$MIGRA2=$conex->query("SELECT participationId FROM participation"
        . "WHERE `coachId` = 0 AND leagueId = $MIGRA1[leagueId]");
$MIGRA3=$conex->query("SELECT cClassId FROM coaches"
        . "WHERE `coachId` = $_SESSION[coachId]");
$conex->autocommit(false);

try {
    $conex->query("DELETE FROM `melol`.`bids` "
            . "WHERE `coachId` = $_SESSION[coachId]");
    $conex->query("UPDATE coachTeam SET participationId = $MIGRA2"
            . "WHERE participationId = $MIGRA1[participationId]");
    if($MIGRA3 === 2){
    $CHADM=$conex->query("SELECT coachId, MIN(joinedDate) as fecha FROM parcitipation"
            . "WHERE coachId != 0 AND coachId != $_SESSION[coachId] AND leagueId = $MIGRA1[leagueId]");
    $conex->query("UPDATE coaches SET cClassId = 2"
            . "WHERE coachId = $CHADM[coachId]");
    }
    $conex->query("");
    $conex->query("DELETE FROM `melol`.`coaches` "
        . "WHERE `coachId` = $_SESSION[coachId]");
    $conex->commit();
    
} catch (Exception $e) {
    $conex->rollback();
    echo 'Something fails: ',  $e->getMessage(), "\n";
}

<?php
//declaracion de variables
session_name('MELOLSESSION');
session_start();
$_SESSION[coachId];
include 'config.php';
//crear una conexion a la base de datos
$conex = new mysqli(localhost, '$phpuser', '$phppass', melol);
//comprobamos si hemos tenido exito
if($conex->connect_errno){
    die("Error al conectarnos a la base de datos: ".$conexion->connect_errno);
}
//Seleccion del id de participacion y el id de la liga en la que esta
$MIGRA1=$conex->query("SELECT participationId, leagueId FROM participation"
        . "WHERE `coachId` = ".$_SESSION['coachId'].";");
//Seleccion del id de participacion de la maquina en la liga del coacher
$MIGRA2=$conex->query("SELECT participationId FROM participation"
        . "WHERE `coachId` = 0 AND leagueId = ".$MIGRA1['leagueId'].";");
//Seleccion del tipo de coach es(administrador(2) o participante)
$MIGRA3=$conex->query("SELECT cClassId FROM coaches"
        . "WHERE `coachId` = ".$_SESSION['coachId'].";");
$conex->autocommit(false);

try {
    //Se borra las pujas activas del coacher
    $conex->query("DELETE FROM `melol`.`bids` "
            . "WHERE `coachId` = ".$_SESSION['coachId'].";");
    //Se pasa el dueño de los jugadores a la maquina
    $conex->query("UPDATE coachTeam SET participationId =".$MIGRA2['participationId']
            . " WHERE participationId = ".$MIGRA1['participationId'].";");
    // Si el coacher es administrador de la liga pasara el el admin al siguiente mas antiguo
    if($MIGRA3['cClassId'] == 2){
    $CHADM=$conex->query("SELECT coachId, MIN(joinedDate) as fecha FROM parcitipation"
            . "WHERE coachId != 0 AND coachId != ".$_SESSION['coachId']." AND leagueId = ".$MIGRA1['leagueId'].";");
    $conex->query("UPDATE coaches SET cClassId = 2"
            . "WHERE coachId = ".$CHADM['coachId'].";");
    }
    //$conex->query("");
    //se borra el coach de las tabla coaches
    $conex->query("DELETE FROM `melol`.`coaches` "
        . "WHERE `coachId` = ".$_SESSION['coachId'].";");
    //si no falla nada se aplican los cambios
    $conex->commit();
    // si falla alguna de las consultas anteriores se vuelve al estado antes de empezar y se muestra el error
} catch (Exception $e) {
    $conex->rollback();
    echo 'Something fails: ',  $e->getMessage(), "\n";
}

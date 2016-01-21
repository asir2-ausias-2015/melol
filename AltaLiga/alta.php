<?php
//Variables
$liga = $_REQUEST['liga'];
$tipo = $_REQUEST['tipo'];
$numero = $_REQUEST['numero'];
//Conexion a BD
$conexion = new mysqli("localhost","root","ausias","melol");
if($conexion->connect_errno){
    die("Error de conexión a la base de datos:".$conexion->connect_error);
}
//sql
$safe_liga = mysqli_real_escape_string($conexion, $liga);
$sql = "SELECT * "
        ."FROM leagues "
        ."WHERE leagueName = '$safe_liga'";

//$result = new mysqli_result();
$result = $conexion->query($sql);
if ($result->num_rows==1){ 
    echo $sql."<br>";
    echo 'Ese nombre de liga ya esta registrado';;   
 ;
}
 elseif ($safe_liga=='' OR $numero=='' OR $tipo='') {
    echo "Completa todos los datos del formulario por favor";
 }
 else {
     echo 'Tu liga se ha creado correctamente';
     $enviar = "INSERT INTO leagues (`leagueName`, `leagueSize`, `leaguePublic`) VALUES ('$safe_liga', $numero, $tipo)";
     echo $sql."<br>";
     echo "</br> $enviar";
      //$result2 = new mysqli_result(); 
      $result2 = $conexion->query($enviar);      
}


;
?>
//Pagina para crear contraseñas de prueba
<?php

$pass1 = password_hash("ausias", PASSWORD_DEFAULT);
$pass2 = password_hash("ausias", PASSWORD_DEFAULT);

$query = "UPDATE `users` "
		. "SET `userPass`=? "
		. "WHERE `userNick='ausias'";

$stmt=$conexion->prepare($query);
$stmt->bind_param('s',$pass1);
$stmt->execute();
$stmt->close();

$query2 = "UPDATE `users` "
		. "SET `userPass`=? "
		. "WHERE `userNick='SiriusBnW'";
$stmt=$conexion->prepare($query2);
$stmt->bind_param('s',$pass2);
$stmt->execute();
$stmt->close();
<?php

include 'conexion.php';
//include_once 'inc/functions.php';

$usuario = filter_input(INPUT_POST, 'usuario', $filter = FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', $filter = FILTER_SANITIZE_STRING); // The hashed password.

if (!login_check($conexion)) {
	if (isset($usuario, $password)) {
		if (sys_user_verify($usuario, $password, $conexion) == true) {
			// Éxito
			$action = $default_action; //acción por defecto

			echo "<div class=\"logout\"> <a href=\"index.php?action=logout\"> Desconectar "
			. $_SESSION['userName']
			. "</a></div>";
		} else {
			// Login error: no coinciden usuario y password
			$action = "login";
			echo "<div class=" . "\"alert alert-danger alert-dismissable text-center clear\" id=\"login_fail\"" . ">
			<button type=" . "button" . " class=" . "close" . " data-dismiss=" . "alert" . ">&times;</button>
				Login incorrecto! Revisa los datos.
			</div>";
		}
	} else {
		//significa que aún no has valores para usuario y password
		$action = "login";
	}
} else { // si estas autorizado
	$action = basename(filter_input(INPUT_GET, 'action', $filter = FILTER_SANITIZE_STRING));

	// In case para definir la accion default segun 'login/logout'
	switch ($action) {
		case 'login': $action = $default_action;
			break;
		case 'logout':sys_session_destroy();
			$action = 'login';
	}
	if ($action != "login") {
		echo "<div class=\"logout\"> <a href=\"index.php?action=logout\"> "
		. "Desconectar " . $_SESSION['userName']
		. "</a></div><br>";
	}
	if (!isset($action)) {
		$action = $default_action; //acción por defecto $default_action = "lista"
	}
	if (!file_exists($action . '.php')) { //comprobamos que el fichero exista
		$action = $default_action; //si no existe mostramos la página por defecto
		echo "Operación no soportada: 404 [Prueba: Default is " . $default_action . " ] and action= " . $action . "!"; //Mostrar un 404
	}
}
include( $action . '.php'); //y ahora mostramos la pagina llamada




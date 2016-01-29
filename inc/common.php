<?php

function sys_session_start() {
	if (!isset($_SESSION)) {
		session_name("MELOLSESSION");
		session_start();
	}
}

function sys_session_test() {
	sys_session_start();

	if (isset($_SESSION["userId"]) && isset($_SESSION["sessionId"]) && isset($_REQUEST["sessionId"])) {
		if ($_SESSION["sessionId"] == $_REQUEST["sessionId"]) {
			return TRUE;
		}
	}
	return FALSE;
}

function sys_session_create($conexion, $force = FALSE) {
	if (!sys_session_test() || $force) {
		$userId = $_SESSION['userId'];

		if (!empty($userId)) {
			$sessionId = md5(uniqid(mt_rand(), true));
			$hashedSessionId = hash('sha512', $sessionId);
			$_SESSION["sessionId"] = $sessionId;
			$_SESSION["userId"] = $userId;

			$sql = "UPDATE `users` "
			     . "SET `userSessionId` = ? "
			     . "WHERE `userId` = ?";

			$stmt = $conexion->prepare($sql);
			$stmt->bind_param('si', $hashedSessionId, $userId);
			$stmt->execute();
			$stmt->close();

			return $sessionId;
		}
	}
	return "";
}

function sys_session_destroy() {
	$_SESSION = array();
	session_destroy();
}

function login_check($conexion) {
	// Comprueba que todas las variables de sesión estén inicializadas
	if (isset($_SESSION['userId'], $_SESSION['userName'], $_SESSION['sessionId'])) {
		$userId = $_SESSION['userId'];
		$sessionId = $_SESSION['sessionId'];

		$query = "SELECT `userSessionId` "
		       . "FROM `users` "
		       . "WHERE `userId` = ?";

		$stmt = $conexion->prepare($query);
		$stmt->bind_param('i', $userId);
		$stmt->execute();
		$stmt->bind_result($sessionCheck);
		$stmt->fetch();

		if ($sessionCheck == hash('sha512', $sessionId)) {
			return true;
		} else {
			return false;
		}
	} else {
		// No está logado
		return false;
	}
}

function sys_user_verify($userName, $userPassword, $conexion) {
	if (!empty($userName) && !empty($userPassword)) {
		$userId = sys_user_getId($userName, $conexion);

		if (!empty($userId)) {
			# read hashed password from database
			$query = "SELECT userPass "
			       . "FROM users "
			       . "WHERE userId = ? "
			       . "LIMIT 1 ";

			$stmt = $conexion->prepare($query);
			$stmt->bind_param('i', $userId);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($db_password); //password de la bd
			$stmt->fetch();

			if (password_verify($userPassword, $db_password)) {
				$_SESSION['userId'] = $userId;
				$_SESSION['userName'] = $userName;
				sys_session_create($conexion);
				return TRUE;
			}
		}
	}
	return FALSE;
}

function sys_user_getId($userName, $conexion) {
	$userId = "";

	if (!empty($userName)) {
		$query = "SELECT `userId` "
		       . "FROM `users` "
		       . "WHERE `userNick` = ? "
		       . "LIMIT 1";

		$stmt = $conexion->prepare($query);
		$stmt->bind_param('s', $userName);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($userId);
		$stmt->fetch();
	}
	return $userId;
}

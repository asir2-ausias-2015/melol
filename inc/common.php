<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function sys_session_test(){
    session_name("MELOLSESSION");
    session_start();
    if (isset($_SESSION["userId"]) && isset($_SESSION["sessionId"]) && isset($_REQUEST["sessionId"])) {
            if ($_SESSION["sessionId"] == $_REQUEST["sessionId"]) {
                return TRUE;
            }
    }
    return FALSE;
}

function sys_session_create($userId, $force = FALSE){
    if (!sys_session_test() || $force){
        if (!empty($userId)) {
            $sessionId = md5(uniqid(mt_rand(), true));
            $_SESSION["sessionId"] = $sessionId;
            $_SESSION["userId"] = $userId;
            return $sessionId;
        }
    }
    return "";
}


function sys_session_destroy(){
    $_SESSION = array();
    session_destroy();
}

function sys_user_verify($userName, $userPassword, $conexion){
    if (!empty($userName) && !empty($userPassword)) {
        $userId = sys_user_getId($userName, $conexion);
        if (!empty($userId)){
            # read hashed password from database
			$stmt = $conexion->prepare("SELECT userPass
										FROM users
										WHERE userId = ?
										LIMIT 1"); 
			$stmt->bind_param('i', $userId);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($db_password); //password de la bd
			$stmt->fetch();
			
            if (password_verify($userPassword , $dbPassword )){
                return TRUE;
            }
        }
    }
    return FALSE;
}

function sys_user_getId($userName, $conexion){
    $userId="";
    if (!empty($userName)) {
        $query = "SELECT `userId` "
		       . "FROM `users`"
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

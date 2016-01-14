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

function sys_user_verify($userName, $userPassword){
    if (!empty($userName) && !empty($userPassword)) {
        $userId = sys_user_getId($userName);
        if (!empty($userId)){
            # read hashed password from database
            $dbPassword = password_hash("melol", PASSWORD_DEFAULT);
            if (password_verify ($userPassword , $dbPassword )){
                return TRUE;
            }
        }
    }
    return FALSE;
}

function sys_user_getId($userName){
    $userId="";
    if (!empty($userName)) {
        # search user in DATABASE
        if ($userName == "melol"){
            #search Id in DATABASE
            $userId = "1" ;
        }
    }
    return $userId;
}

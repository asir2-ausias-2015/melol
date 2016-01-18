<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor. 
-->
<!-- Añadir delante de los .php que necesiten login o en el controlador
	<?php
    //    include 'inc/common.php';
    //    if (! sys_session_test()) {
    //       header("Location: index.php?action=login");
    //    }
	?> 
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>MELOL</title>
	    <link media="all" href="http://172.20.109.26/php/proyecto_crud/css/style.css" rel="stylesheet" type="text/css"></link>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </head>
    <body>
    <div class="container">
        <div id="wrapper">
            <div id="header">
                <div id="logo">
                    <img src="img/logo_web.png"></img>
                </div>
                <div id="title">
                    Manager Emulator LOL
                </div>

            </div>
            <nav class="melolbar">
                <div><a href="index.php">Inicio</a></div>
                <div><a href="index.php?action=altas">Altas</a></div>
            </nav>
            <div id="content">
            <?php
            // controlador.php se encargara de mostrar el 'contenido' correspondiente
                include('./controlador.php');
            ?>
            </div>
            <div id="footer">
            <div class="pull-left"><kbd>#MELOL</kbd></div>
                <div id="13" class="pull-right"><kbd>ASIR (2016)</kbd></div>
            </div>
        </div>
    </div>
    </body>
</html> 

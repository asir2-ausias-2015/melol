<?php
include 'inc/common.php';
sys_session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>MELOL</title>
	    <link media="all" href="css/style.css" rel="stylesheet" type="text/css"></link>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
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
				<div><a href="index.php?action=clasification">Clasificación</a></div>
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

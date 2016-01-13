<html>
    <head>
        <meta charset="UTF-8">
        <title>Proyecto CRUD</title>
	<link media="all" href="css/style.css" rel="stylesheet" type="text/css"></link>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script type="text/JavaScript" src="js/sha512.js"></script>
	<script type="text/JavaScript" src="js/forms.js"></script>
    <script type="text/JavaScript" src="js/pipati.js"></script>
        <script type="text/JavaScript">
            function borra_cliente(id){
        		var answer = confirm('¿Estás seguro que deseas borrar el cliente?');
        		if (answer) {
        		// si el usuario hace click en ok,
        		// se ejecutar borra.php
        		window.location = 'borra.php?id=' + id;
        		}
            }
        </script>
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
        <div><a href="index.php?action=login">Inicio</a></div>
        <div><a href="index.php?action=altas">Altas</a></div>
        <div id="pipati"><button onclick="pipati()">¿Quieres jugar?</button></div>
    </nav>
	<div id="content">
	<?php
	// controlador.php se encargara de mostrar el 'contenido' correspondiente
	    include('controlador.php');
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

<?php
    // SESION GOES HERE
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Clasificación</title>
        <!-- CSS GOES HERE -->
    </head>
    <body>
        <?php
            require '/credentials.php';
                    
            $conexion = new mysqli($dbConn['host'], $dbConn['user'], $dbConn['pass'], $dbConn['db']);

            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }
        ?>
        <!-- HEADER START -->
        <!-- HEADER END -->
        <?php
            
        ?>
        <!-- FOOT START -->
        <!-- FOOT END -->
    </body>
</html>

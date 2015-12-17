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

            $conn = new mysqli($dbConn['host'], $dbConn['user'], $dbConn['pass'], $dbConn['db']);

            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            $sql = "SELECT *"
                    . "FROM `coachLeaderboard"
                    . "WHERE leagueId = '" . $league . "';";

            print($sql);

            $result=$conexion->query($sql);

        ?>
        <!-- HEADER START -->
        <!-- HEADER END -->
        <?php
            
        ?>
        <!-- FOOT START -->
        <!-- FOOT END -->
    </body>
</html>

<?php
	// SESION GOES HERE
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<title>Clasificación</title>
		<!-- CSS GOES HERE -->
		<style>
		.padd50T{
			padding-top: 40px;
		}
		.padd5B{
			padding-bottom: 5px;
		} 
		.b3solidGrey {
			border: 3px solid #a9a9a9;
		}
		.width25 {
			width: 25px;
		}
		.width70 {
			width: 70px;
		}
		.maxwidth140 {
			max-width: 140px;
		}
		.minwidth100 {
			min-width: 100px;
		}
		.minwidth25 {
			min-width: 25px;
		}
		</style>
	</head>
	<body> 
		<?php
			require '../config.php';

			$conn = new mysqli($config['dbHost'], $config['dbUser'], $config['dbPass'], $config['dbName']);

			if ($conn->connect_error) {
				die("Error de conexión: " . $conn->connect_error);
			}

			$sql = "SELECT * "
					. "FROM `coachLeaderboard` "
					. "WHERE `league` = '1';";

			$result=$conn->query($sql);

		?> 
		<!-- HEADER START -->
		<!-- HEADER END -->
		<!-- BODY START -->
                <div class="container ">
                    <div class="padd50T padd5B"><span>Nombre Liga</span><span class="pull-right">Jornada X/Y</span></div>
                    <!-- TABLE START -->
                    <div>
                        <table class="table table-striped table-bordered table-hover table-condensed b3solidGrey"> 
			<tr>
				<th scope="col" class="width25">Pos.</th>
				<th scope="col" class="minwidth25 width25">&nbsp;&nbsp;</th>
				<th scope="col" class="minwidth100 maxwidth140">Equipo</th>
				<th scope="col" class="minwidth100 maxwidth140">Coach</th>
				<th scope="col" class="minwidth100 maxwidth140">Valor equipo</th>
				<th scope="col" class="minwidth100 width70">Puntos</th>
			</tr>
                    <?php
                            if($result->num_rows>=1){
                                    $row=$result->fetch_assoc();
                                    for ($i = 1; $i <= count($row); $i++) {
                    ?>
			<tr>
				<td>
					<?php
						// Later code to put image
					?>
				</td>
				<td><?php echo $i; ?></td>
				<td><?php echo $row[$i]['name']; ?></td>
				<td><?php echo $row[$i]['team']; ?></td>
				<td class="text-right"><?php echo $row[$i]['money']; ?></td>
				<td class="text-right"><?php echo $row[$i]['points']; ?></td>
			</tr>
                    <?php
                                    }
                            } else {
                    ?>
                        <tr>
                            <td colspan="6" class="text-center"> No hay datos que mostrar ahora mismo. </td>
                        </tr>
		<?php
			}
		?>
                        </table>
                    </div>
		<!-- TABLE END -->
		<!-- BODY END -->
                    <div><a href="#">FAQ: Sistema de puntuación</a></div>
                </div>
		<!-- FOOT START -->
		<!-- FOOT END -->
		<?php
			$result->free();
			$conn->close();
		?>
	</body>
</html>

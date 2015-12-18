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
			require '../config.local.php';

			$conn = new mysqli($config['dbHost'], $config['dbUser'], $config['dbPass'], $config['dbName']);

			if ($conn->connect_error) {
				die("Error de conexión: " . $conn->connect_error);
			}

			$sql = "SELECT * "
					. "FROM `coachLeaderboard` "
					. "WHERE `league` = '1';";

			print($sql);

			$result=$conexion->query($sql);

		?>
		<!-- HEADER START -->
		<!-- HEADER END -->
		<!-- BODY START -->
		<!-- TABLE START -->
		<?php
			if($result->num_rows>=1){
				$row=$result->fetch_assoc();
				for ($i = 1; $i <= count($row); $i++) {
		?>
			<tr>
				<td><?php echo $i; ?></td>
				<!-- Hasta tener la tabla history_league
					<td><?php echo $i; ?></td> 
				-->
				<td><?php echo $row[$i]['name']; ?></td>
				<td><?php echo $row[$i]['team']; ?></td>
				<td><?php echo $row[$i]['money']; ?></td>
				<td><?php echo $row[$i]['points']; ?></td>
			</tr>
		<?php
				}
		?>
		<!-- TABLE END -->
		<?php
			} else {
				 die("Ha ocurrido un error: ".$conexion->error);
			}
		?>
		<!-- BODY END -->
		<!-- FOOT START -->
		<!-- FOOT END -->
		<?php
			$result->free();
			$conn->close();
		?>
	</body>
</html>

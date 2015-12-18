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

			$result=$conn->query($sql);

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
				<td>
					<?php
						// Later code to put image
					?>
				</td>
				<td><?php echo $i; ?></td>
				<td><?php echo $row[$i]['name']; ?></td>
				<td><?php echo $row[$i]['team']; ?></td>
				<td><?php echo $row[$i]['money']; ?></td>
				<td><?php echo $row[$i]['points']; ?></td>
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
		<!-- TABLE END -->
		<!-- BODY END -->
		<!-- FOOT START -->
		<!-- FOOT END -->
		<?php
			$result->free();
			$conn->close();
		?>
	</body>
</html>

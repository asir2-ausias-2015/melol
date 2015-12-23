<?php
require '../config.php';
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
		$conn = new mysqli($config['dbHost'], $config['dbUser'],
				$config['dbPass'], $config['dbName']);

		if ($conn->connect_errno) {
			die("Error de conexión: " . $conn->connect_error);
		}

		$sql = "SELECT * "
			. "FROM `coachLeaderboard` "
			. "WHERE `league` = '1'";

		$result = $conn->query($sql);
		?>
		<div class="container">
			<!-- HEADER START -->
			<!-- HEADER END -->
			<!-- BODY START -->
			<div class="padd50T padd5B"><span>Nombre Liga</span><span class="pull-right">Jornada X/Y</span></div>
			<!-- TABLE START -->
			<div>
				<table class="table table-striped table-bordered table-hover table-condensed b3solidGrey">
					<tr>
						<th scope="col" colspan="2">Pos.</th>
						<th scope="col" class="minwidth100 maxwidth140">Equipo</th>
						<th scope="col" class="minwidth100 maxwidth140">Coach</th>
						<th scope="col" class="minwidth100 maxwidth140">Valor equipo</th>
						<th scope="col" class="minwidth100 width70">Puntos</th>
					</tr>
					<?php
					if ($result->num_rows >= 1) {
						$i = 1;
						while ($row = $result->fetch_assoc()) {
							?>
							<tr>
								<td class="width25">
									<?php
									// Later code to put image
									?>
								</td>
								<td class="width25"><?php echo $i; ?></td>
								<td><?php echo $row['team']; ?></td>
								<td><?php echo $row['coach']; ?></td>
								<td class="text-right"><?php echo $row['money']; ?></td>
								<td class="text-right"><?php echo $row['points']; ?></td>
							</tr>
							<?php
							$i++;
							if ($i > 10) {
								die("STOP!!");
							}
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
			</div>
			<div><a href="#">FAQ: Sistema de puntuación</a></div>
			<!-- BODY END -->
			<!-- FOOT START -->
			<!-- FOOT END -->
			<?php
			$result->free();
			$conn->close();
			?>
		</div>
	</body>
</html>

<?php
require '../config.local.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery-2.1.4.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
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

		$conn->set_charset("utf8");
		$id = 1;
		?>
		<div class="container">
			<!-- HEADER START -->
			<!-- HEADER END -->
			<!-- BODY START -->
			<?php
			$sql = "SELECT `leagueName` "
					. "FROM `leagues` "
					. "WHERE `leagueId` = ?";

			$stmt = $conn->prepare($sql);
			$stmt->bind_param('i', $id);
			$stmt->execute();
			$stmt->bind_result($leaguename);
			$stmt->fetch();
			?>
			<div class="padd50T padd5B"><span><?php echo htmlspecialchars($leaguename, ENT_QUOTES); ?></span><span class="pull-right">Jornada X/Y</span></div>
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
					$stmt->free_result();

					$sql2 = "SELECT `team`, `coach`, `money`, `points` "
							. "FROM `coachLeaderboard` "
							. "WHERE `league` = ?";

					$stmt2 = $conn->prepare($sql2);
					$stmt2->bind_param('i', $id);
					$stmt2->execute();
					$stmt2->store_result();

					if ($stmt2->num_rows >= 1) {
						$i = 1;
						$stmt2->bind_result($team, $coach, $money, $points);
						while ($stmt2->fetch()) {
							?>
							<tr>
								<td class="width25">
									<?php
									// Later code to put image
									?>
								</td>
								<td class="width25"><?php echo $i; ?></td>
								<td><?php echo htmlspecialchars($team, ENT_QUOTES); ?></td>
								<td><?php echo htmlspecialchars($coach, ENT_QUOTES); ?></td>
								<td class="text-right"><?php echo htmlspecialchars($money, ENT_QUOTES); ?></td>
								<td class="text-right"><?php echo htmlspecialchars($points, ENT_QUOTES); ?></td>
							</tr>
							<?php
							$i++;
						}
						$stmt2->free_result();
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
			$conn->close();
			?>
		</div>
	</body>
</html>

<h1>Clasificacion</h1>
<?php
//MODO TEST: Sacarlo de una variable de sesion o de una query
$id = 2;

$sql = "SELECT `leagueName` "
		. "FROM `leagues` "
		. "WHERE `leagueId` = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($leaguename);
$stmt->fetch();
?>
<div class="padd50T padd5B"><span><?php echo htmlspecialchars($leaguename, ENT_QUOTES); ?></span><span class="pull-right "> Jornada X/Y</span></div>
<!-- TABLE START -->
<div>
	<table class="table table-hover table-condensed" style="max-width:98%">
		<tr>
			<th scope="col" colspan="2">Pos.</th>
			<th scope="col" class="minwidth100 maxwidth140">Equipo</th>
			<th scope="col" class="minwidth100 maxwidth140">Coach</th>
			<th scope="col" class="minwidth100 maxwidth140">Valor equipo</th>
			<th scope="col" class="minwidth100 width70">Puntos</th>
		</tr>
		<?php
		$stmt->free_result();

		$sql2 = "SELECT `team`, `name`, `money`, `points` "
				. "FROM `coacherLeaderboard` "
				. "WHERE `league` = ?";

		$stmt2 = $conexion->prepare($sql2);
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
$conexion->close();
?>

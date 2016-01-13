<h1>Lista Clientes</h1>
<?php
$action = isset($_GET['action']) ? $_GET['action'] : "";

// si viene de borra.php
if ($action == 'deleted') {
    echo "<div>El registro cliente ha sido borrado.</div><br>";
}

// Elegir los datos que deseamos recuperar de la tabla
$query = "SELECT usersId,userMail,userNick,userSignedDate,userPoints,userLevel "
	. "FROM users "
	. "ORDER BY userId";

// Preparamos y ejecutamos la consulta
if ($stmt = $conexion->prepare($query)) {
if (!$stmt->execute()) {
    die('Error de ejecución de la consulta. ' . $conexion->error);
} 

// recogemos los datos
$stmt->bind_result($usersId,$userMail,$userNick,$userSignedDate,$userPoints,$userLevel);

// enlace a alta
echo "<div>";
echo "<a href='index.php?action=altas'>Alta usuario</a>";
echo "</div>";

//cabecera de los datos mostrados
echo "<table class="."table>"; //start table
//creating our table heading
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Email</th>";
echo "<th>Nick</th>";
echo "<th>Fecha Registro</th>";
echo "<th>Puntos</th>";
echo "<th>Nivel</th>";
echo "</tr>";
//recorrido por el resultado de la consulta
while ($stmt->fetch()) {
echo "<tr>";
echo "<td>$usersId</td>";
echo "<td>$userMail</td>";
echo "<td>$userNick</td>";
echo "<td>$userSignedDate</td>";
echo "<td>$userPoints</td>";
echo "<td>$userLevel</td>";
echo "<td>";
// Este enlace es para modificar el registro
echo "<a href='index.php?action=edita&id={$id}'>Edita</a>";
echo " / ";
// Este enlace es para borrar el registro y también se explicará más tarde
echo "<a href='javascript:borra_cliente(\"$id\")'> Elimina </a>";
echo "</td>";
echo "</tr>\n";
}
// end table
echo "</table>";
$stmt->close();
} else {
die('Imposible preparar la consulta. ' . $conexion->error);
}
?>

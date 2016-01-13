<h1>Lista Clientes</h1>
<?php
$action = isset($_GET['action']) ? $_GET['action'] : "";

// si viene de borra.php
if ($action == 'deleted') {
    echo "<div>El registro cliente ha sido borrado.</div><br>";
}

// Elegir los datos que deseamos recuperar de la tabla
$query = "SELECT id,nif,nombre,apellido1,apellido2,email,telefono,usuario "
	. "FROM clientes "
	. "ORDER BY apellido1, apellido2, nombre";

// Preparamos y ejecutamos la consulta
if ($stmt = $conexion->prepare($query)) {
if (!$stmt->execute()) {
    die('Error de ejecución de la consulta. ' . $conexion->error);
} 

// recogemos los datos
$stmt->bind_result($id,$nif,$nombre,$apellido1,$apellido2,$email,$telefono,
	$usuario);

// enlace a alta
echo "<div>";
echo "<a href='index.php?action=altas'>Alta cliente</a>";
echo "</div>";

//cabecera de los datos mostrados
echo "<table class="."table>"; //start table
//creating our table heading
echo "<tr>";
echo "<th>NIF</th>";
echo "<th>Nombre</th>";
echo "<th>Apellido 1</th>";
echo "<th>Apellido 2</th>";
echo "<th>email</th>";
echo "<th>telefono</th>";
echo "<th>usuario</th>";
echo "</tr>";
//recorrido por el resultado de la consulta
while ($stmt->fetch()) {
echo "<tr>";
echo "<td>$nif</td>";
echo "<td>$nombre</td>";
echo "<td>$apellido1</td>";
echo "<td>$apellido2</td>";
echo "<td>$email</td>";
echo "<td>$telefono</td>";
echo "<td>$usuario</td>";
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

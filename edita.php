<h1>Editar cliente</h1>
<?php
// coger el parámetro que nos permitirá identificar el registro
// isset() es una función PHP usado para verificar si una variable tiene valor o no
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Registro no encontrado.');

include 'conexion.php';

// hacer que las modificaciones hechas en edita.php sean guardadas en la BD
if ($_POST) {
    // escribir en la tabla cliente
    $query = "UPDATE users "
    . "SET userMail=?, userNick=?, userPass=?, "
    . "WHERE userId = ?";
    
    $stmt = $conexion->prepare($query);
    
    $stmt->bind_param('sssi', $_POST['userMail'],
    $_POST['userNick'], $_POST['userPass'],$id);
    
    if ($stmt->execute()) {
    echo "Registro actualizado";
    } else {
    echo 'Error al actualizar.';
    }
}


// leer el registro de la tabla
$query = "SELECT userMail, userNick, userPass "
    . "FROM users "
    . "WHERE userId = ? ";

if ($stmt = $conexion->prepare($query)) {
    
    // inicializamos el parámetro
    $stmt->bind_param('d', $id);
    
    // ejecutamos la consulta
    $stmt->execute();
    $stmt->bind_result($userMail, $userNick, $userPass);
    
    // recuperamos la variable
    $stmt->fetch();
}
?>
<form action='edita.php?id=<?php echo htmlspecialchars($id); ?>' method='post'
border='0'>
    <table>
	<tr>
	    <td>userMail:</td>
	    <td><input type='text' name='userMail' value="<?php echo htmlspecialchars($userMail, ENT_QUOTES); ?>" /></td>
	</tr>
	<tr>
	    <td>userNick:</td>
	    <td><input type='text' name='userNick' value="<?php echo htmlspecialchars($userNick, ENT_QUOTES); ?>" /></td>
	</tr>
	<tr>
	    <td>userPass</td>
	    <td><input type="text" name='userPass' value="<?php echo htmlspecialchars($userPass, ENT_QUOTES); ?>" /></td>
	</tr>
	<tr>
	    <td></td>
	    <td>
		<input type='submit' value='Guardar' />
		<a href="./index.php?action=<?php echo $default_action ?>">Volver a Inicio</a>
	    </td>
	</tr>
    </table>
</form>
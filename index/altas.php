<h1>Alta Cliente</h1>
<?php
/* Si se llama desde el form, contendra datos de 'input' y al no ser
 * $_POST falso se ejecutar primero el PHP, si no hubiese datos y fuese
 * falso se ignoraria el PHP y mostraria el formulario.
 */
    if($_POST){
	// include conexion a la BD -> de aqui obtenemos $conexion
	include 'conexion.php';

	// insert query
	$query = "REPLACE clientes "
		. "SET nif=?,nombre=?,apellido1=?,apellido2=?,"
		. "email=?,telefono=?,"
		. "usuario=?,password=? ";
	echo $query,"<br>";

	// prepare query for execution -> Aquí se comprueba la sintaxis
	//  de la consulta y se reservan los recursos necesarios
	//  para ejecutarla.
	if ($stmt = $conexion->prepare($query)){
	    echo "<div>registro preparado.</div>";
	} else {
	    die('Imposible preparar el registro.'.$conexion->error); 
	}

	// asociar los parámetros
	$stmt->bind_param('ssssssss',$_POST['nif'],$_POST['nombre'],
	$_POST['apellido1'],$_POST['apellido2'],$_POST['email'],
	$_POST['telefono'],$_POST['usuario'],$_POST['password']);

	// ejecutar la query
	if($stmt->execute()){
	    echo "<div>Registro guardado.</div>";
	} else {
	    die('Imposible guardar el registro:'.$conexion->error);
	}
    }
?>
<form action='altas.php' method='post'>
<table border='0'>
    <tr>
	<td>NIF</td>
	<td><input type='text' name='nif' /></td>
    </tr>
    <tr>
	<td>Nombre</td>
	<td><input type='text' name='nombre' /></td>
    </tr>
	<tr>
	<td>1er Apellido</td>
    <td><input type='text' name='apellido1'></textarea></td>
    </tr>
    <tr>
	<td>2o Apellido</td>
	<td><input type='text' name='apellido2'></textarea></td>
    </tr>
<!--            <tr>
	<td>login</td>
	<td><input type='text' name='login' /></td>
    </tr>-->
    <tr>
	<td>email</td>
	<td><input type='text' name='email' /></td>
    </tr>
    <tr>
	<td>telefono</td>
	<td><input type='text' name='telefono' /></td>
    </tr>
    <tr>
	<td>usuario</td>
	<td><input type='text' name='usuario' /></td>
    </tr>
    <tr>
	<td>password</td>
	<td><input type='text' name='password' /></td>
    </tr>
    <tr>
	<td></td>
	<td>
	<input type="submit" name="save" value="Save" />
	<a href="./index.php?action=<?php echo $default_action ?>">Volver al inicio</a>
	</td>
    </tr>
</table>
</form>



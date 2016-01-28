<h1>Alta usuario</h1>
<?php
/* Si se llama desde el form, contendra datos de 'input' y al no ser
 * $_POST falso se ejecutar primero el PHP, si no hubiese datos y fuese
 * falso se ignoraria el PHP y mostraria el formulario.
 */
    if($_POST){
    /*	// include conexion a la BD -> de aqui obtenemos $conexion
    	include 'conexion.php';*/
        if (!($_POST['password'] == $_POST['repassword'])){
            echo "<h4>Las contraseñas no coinciden</h4><br>";
        } else {
            // insert query
        	$query = "REPLACE users "
        		. "SET userNick=?,userMail=?,userPass=? ";
        	echo $query,"<br>";

        	// prepare query for execution -> Aquí se comprueba la sintaxis
        	//  de la consulta y se reservan los recursos necesarios
        	//  para ejecutarla.
        	if ($stmt = $conexion->prepare($query)){
        	    echo "<div>Registro reparado.</div>";
        	} else {
        	    die('Imposible preparar el registro.'.$conexion->error); 
        	}

        	// asociar los parámetros
        	$stmt->bind_param('sss',$_POST['usuario'],$_POST['email'],$_POST['password']);

        	// ejecutar la query
        	if($stmt->execute()){
        	    echo "<div>Registro guardado.</div>";
        	} else {
        	    die('Imposible guardar el registro:'.$conexion->error);
        	}
        }
    }
?>
<form action='altas.php' method='post'>
<table border='0'>
    <tr>
	<td>Usuario</td>
	<td><input type='text' name='usuario' /></td>
    </tr>
    <tr>
	<td>Correo electronico</td>
	<td><input type='text' name='email' /></td>
    </tr>
    <tr>
	<td>Contraseña</td>
	<td><input type='text' name='password' /></td>
    </tr>
    <td>Repite contraseña</td>
    <td><input type='text' name='repassword' /></td>
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



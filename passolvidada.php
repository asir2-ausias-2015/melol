<?php
if (isset($_POST['submit'])) {	// Se ha recibido un formulario.
	// Limpia y valida el string de tipo correo.
	$email = filter_var(
			filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
			FILTER_VALIDATE_EMAIL
			);

	$sql = "SELECT * FROM `users` WHERE `userMail` = ?";
	$stmt = $conexion->prepare($sql);
	$stmt->bind_param('s', $email);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows == 1) {
		// Token aleatorio de verificación
		$token = base64_encode(openssl_random_pseudo_bytes(16));

		// Debe de ser codificado de forma valida en una URL.
		$verifyemail = urlencode($email);
		$verifystring = urlencode($token);

		// UPDATE la tabla de la base de datos.

		// Mensaje en HTML
		$htmlBody = <<<_HTMLMAIL_
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Recuperación de contraseña</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body>
		<h2>Saludos,</h2>
		<p>Una solicitud ha sido enviada para restrablecer la contraseña de su cuenta.<br/>
		Por favor, accesa al siguiente link para dirigirse a la página de restablecimiento de contraseña:<br/></p>

		<a href="{$config['webProto']}://{$config['webHost']}/index.php?action=resetpass&email=$verifyemail&verify=$verifystring">Click aquí</a>

		<p>Si usted ha recibido este correo por error o no lo ha solicitado, puede ignorarlo.</p>

		<p>Atentamente,<br/>
		Equipo de MELoL</p>
	</body>
</html>
_HTMLMAIL_;

		// Mensaje en texto plano
		$altBody = <<<_TEXTMAIL_
Saludos,
Una solicitud ha sido enviada para restrablecer la contraseña de su cuenta.
Por favor, accesa al siguiente link para dirigirse a la página de restablecimiento de contraseña:

{$config['webProto']}://{$config['webHost']}/index.php?action=restablecerpass&email=$verifyemail&verify=$verifystring

Si usted ha recibido este correo por error o no lo ha solicitado, puede ignorarlo.

Atentamente,
Equipo de MELoL
_TEXTMAIL_;

		require './inc/PHPMailer/PHPMailerAutoload.php';
		$mailer = new PHPMailer();
		$mailer->IsSMTP();
		$mailer->IsHTML(true);
		$mailer->Host = $config['mailHost'];
		$mailer->SMTPSecure = $config['mailSecure'];
		$mailer->Port = $config['mailPort'];
		$mailer->SMTPAuth = TRUE;
		$mailer->Username = $config['mailUser'];
		$mailer->Password = $config['mailPass'];
		$mailer->From = $config['mailUser'];
		$mailer->FromName = $config['mailRealName'];
		$mailer->CharSet = 'UTF-8';
		$mailer->Body = $htmlBody;
		$mailer->AltBody = $altBody;
		$mailer->Subject = "Recuperación de contraseña";
		$mailer->AddAddress($email);


		if(!$mailer->Send()){	// El mensaje no se ha podido enviar
			echo "El mensaje no ha sido enviado <br/>";
			echo "Mailer Error: " . $mailer->ErrorInfo;
		} else {	// El mensaje se ha enviado
			?>
			<div class="alert alert-success">
				<p>Se te ha enviado un correo con las instrucciones para restrablecer su contraseña.</p>

				<a href="index.php?action=login">Volver</a> a la página de inicio de sesión.
			</div>
	<?php }
	}
} else {	// No se ha recibido un formulario.
	?>
	<div style="margin: 10px 0px">
		<h1>¿Olvidaste su contraseña?</h1>
		<p>
			Para restrablecer tu contraseña, introduzca su contraseña debajo.<br/>
			Le enviaremos un enlace para resetear su contraseña.
		</p>
		<form action="index.php?action=passolvidada" method="post">
			<div style="margin: 10px 0px">
				<input style="width: 300px" type="email" name="email" id="email" placeholder="Correo electronico" /></br>
			</div>
			<input class="btn btn-default" type="submit" name="submit" value="Restrablecer" />
			<input class="btn btn-default" type="button" onclick="location.href='index.php'" value="Cancelar" />
		</form>
	</div>
	<?php
}
?>
<?php
  require 'includes\db.php';

  $message = '';

  if (!empty($_POST['name']) && !empty($_POST['pass']) && !empty($_POST['pass-confirm'])) {
    $sql = "INSERT INTO users (name, pass) VALUES (:name, :pass)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $_POST['name']);
    
    $password = password_hash($_POST['pass'], PASSWORD_BCRYPT);
    $stmt->bindParam(':pass', $password);

    if ($stmt->execute()) {
      $message = '¡Usuario registrado exitoxamente!';
    } else {
      $message = '¡No se ha podido crear el usuario!';
    }
   }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="resources\style.css">
	<link rel="icon" type="image/png" href="Imagenes\icono.ico">
	<title>Blog2Watch</title>
</head>
<body class="body-Login">
	<img src="Imagenes/logoblog.png" class="logoblog2">
	<Caja class="caja">
		<?php 
			if (!empty($message)) {
				echo '<p class="message">', $message ,'</p>';
			}
		?>
		<form class="align align-color" method="POST" action="sign_up.php">
			<div class="row">
				<label class="mb-3">Nombre de usuario</label>
				<input class="col-md-10 mb-2" type="text" name="name" maxlength="20" minlength="5" required>
				<label class="mb-3">Contraseña</label>
				<input class="col-md-10 mb-3" id="pass" type="password" name="pass" minlength="6" maxlength="20" required>
				<label class="mb-3">Confirmar contraseña <p class="coincide" id="demo"></p></label>
				<input class="col-md-10 mb-3" id="pass-confirm" type="password" name="pass-confirm" minlength="6" required>
				<terminos class="col-md-10 mb-3 content">
					<input type="checkbox" name="terms" required> No he leído, pero si acepto terminos y condiciones. <a href="javascript:to_open()">Terminos</a>
			  </terminos>
				<input class="col-md-10 button-Login mb-3" type="submit" value="Registrar"> 
			</div>
		</form>
		<p class="color-align">¿Ya tienes un cuenta? <a href="login.php">Inicia sesión</a></p>
	</Caja>
	<div class="ventana-terms" id="vent">
		<cerrar class="position" id="close">
			<a href="javascript:close()"><img src="Imagenes/error.png"></a>
		</cerrar>
		<p>Reglas</p>
	</div>
	<script src="resources/script.js"></script>
</body>
</html>
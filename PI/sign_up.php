<?php
  require 'includes\db.php';

  $message = '';
  $message2 = '';

  if (!empty($_POST['name']) && !empty($_POST['pass']) && !empty($_POST['pass-confirm'])) {
  	$records = $conn->prepare('SELECT id, name, pass FROM users WHERE name = :name');
    $records->bindParam(':name', $_POST['name']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (is_countable($results) > 0) {
    	$message2 = 'El usuario ya existe';
    } else {
	    $sql = "INSERT INTO users (name, pass) VALUES (:name, :pass)";
	    $stmt = $conn->prepare($sql);
	    $stmt->bindParam(':name', $_POST['name']);
	    
	    $password = password_hash($_POST['pass'], PASSWORD_BCRYPT);
	    $stmt->bindParam(':pass', $password);

	    if ($stmt->execute()) {
	      $message = '¡Usuario registrado exitoxamente!';
	    } else {
	      $message2 = '¡No se ha podido crear el usuario!';
	    }
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
<body class="body">
	<div>
		<div><img src="Imagenes/logoblog.png" class="logoblog2"></div><br>
		<div>	<sign-up class="registro">
		<?php 
			if (!empty($message)) {
				echo '<p class="message">', $message ,'</p>';	
			}
			if (!empty($message2)) {
				echo '<p class="message2">', $message2 ,'</p>';
			}
		?>
		<form method="POST" action="sign_up.php" class="margin-bottom">
			<label>Nombre de usuario</label><br>
			<input class="align-input" type="text" name="name" maxlength="20" minlength="5" required><br>
			<label>Contraseña</label><br>
			<input class="align-input" id="pass" type="password" name="pass" minlength="6" maxlength="20" required>
			<br>
			<label>Confirmar contraseña <p class="coincide" id="demo"></p></label><br>
			<input class="align-input" id="pass-confirm" type="password" name="pass-confirm" minlength="6" required>
			<br>
			<terminos>
				<input type="checkbox" name="terms" required> Acepto terminos y condiciones. <a href="javascript:to_open()">Terminos</a>
			</terminos>
			<input class="button-submit align-input" type="submit" value="Registrar"> 
		</form>
		<p align="center">¿Ya tienes un cuenta? <a href="login.php">Inicia sesión</a></p>
	</sign-up></div>
	</div>
	<div class="ventana-terms" id="vent">
		<p style="display: inline;">Terminos y Condiciones</p><a href="javascript:close()"><img src="Imagenes/error.png" width="25" height="25" align="right"></a>
		<p></p>
	</div>
	<script src="resources/script.js"></script>
</body>
</html>
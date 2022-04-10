<?php
  require 'includes\db.php';

  session_start();

  if (!empty($_POST['name']) && !empty($_POST['pass'])) {
    $records = $conn->prepare('SELECT * FROM users WHERE name = :name');
    $records->bindParam(':name', $_POST['name']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (is_countable($results) > 0 && password_verify($_POST['pass'], $results['pass'])) {
      	if ($results['name'] == 'Administrador'){
      		$_SESSION['user_id'] = $results['id'];
     			header("Location: index-administrador.php");
      	}else{
      		$_SESSION['user_id'] = $results['id'];
     			header("Location: index-user.php");
      	}
    } else {
      $message = 'El Usuario y/o contraseña son incorrectos';
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
<body class="body2">
	<img src="Imagenes/logoblog.png" class="logoblog">
	<Inicio-sesion class="login">
		<?php 
			if (!empty($message)) {
				echo '<p class="message-error">', $message ,'</p>';
			}
		?>
		<p align="center">Por favor, escriba la información de su cuenta para iniciar sesión</p>
		<form class="margin-bottom" method="POST" action="login.php">
			<label>Usuario</label>
			<input class="align-input" type="text" name="name" required>
			<label>Contraseña</label>
			<input class="align-input" type="password" name="pass" required>
			<input class="button-submit align-input" type="submit" value="Ingresar"> 
		</form>
		<p align="center">¿No tienes una cuenta? <a href="sign_up.php">Regístrate</a></p>
	</Inicio-sesion>
	<img class="logowelcome" src="Imagenes/logowelcom.png">
</body>
</html>
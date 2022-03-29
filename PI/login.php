<?php
  require 'includes\db.php';

  session_start();

  if (!empty($_POST['name']) && !empty($_POST['pass'])) {
    $records = $conn->prepare('SELECT id, name, pass FROM users WHERE name = :name');
    $records->bindParam(':name', $_POST['name']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (is_countable($results) > 0 && password_verify($_POST['pass'], $results['pass'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: index.php");
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
<body class="body-Login">
	<img src="Imagenes/logoblog.png" class="logoblog">
	<Caja class="caja">
		<?php 
			if (!empty($message)) {
				echo '<p class="messagelogin">', $message ,'</p>';
			}
		?>
		<div class="col-md-10 content">
			<p class="color-align mb-4">Por favor, escriba la información de su cuenta para iniciar sesión</p>
		</div>
		<form method="POST" action="login.php" class="align align-color">
			<div class="row">
				<label class="mb-3">Usuario</label>
				<input type="text" name="name" class="col-md-10 mb-2">
				<label class="mb-3">Contraseña</label>
				<input type="password" name="pass" class="col-md-10 mb-3">
				<input type="submit" value="Ingresar" class="col-md-10 button-Login mb-3"> 
			</div>
		</form>
		<p class="color-align">¿No tienes una cuenta? <a href="sign_up.php">Regístrate</a></p>
	</Caja>
	<img src="Imagenes/logowelcom.png" class="logowelcome">
</body>
</html>
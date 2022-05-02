<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="resources\css\style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<link rel="icon" type="image/png" href="Imagenes\icono.ico">
	<title>Blog2Watch</title>
</head>
<body class="body2">
	<div class="container">
		<content class="row" style="padding: 10px;">
			<header class="col-lg-12">
					<div align="center">
						<img src="Imagenes/logoblog.png" class="logo">
					</div>
			</header>
			<section class="col-lg-4 position-center form-users">
				<?php 
					require 'includes\users.php';
					
					if (!empty($message2)) {
						echo '<p class="message-error">' . $message2 . '</p>';	
					}
				?>
				<form method="POST" action="recuperar.php">
					<div class="form-floating mt-2 mb-3">
						<input class="align-input form-control" type="text" name="user"  maxlength="20" minlength="5" required id="floatingInput" placeholder="username">
						<label for="floatingInput"><span><i class="bi bi-person-fill"></i></span> Usuario</label>
					</div>
					<input class="button-submit align-input mb-3" type="submit" value="Continuar"> 
				</form>
				<p align="center">¿No tienes una cuenta? <a href="sign_up.php">Regístrate</a><br>¿Recordaste tú contraseña? <a href="login.php">Inicia sesión</a></p>
			</section>
		</content>
	</div>
</body>
	<script src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>
</html>
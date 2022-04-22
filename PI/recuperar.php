<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="resources\style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<link rel="icon" type="image/png" href="Imagenes\icono.ico">
	<title>Blog2Watch</title>
</head>
<body class="body2">
	<div class="container">
		<content class="row" style="padding: 10px;">
			<header class="col-lg-12">
					<div align="center">
						<img src="Imagenes/logoblog.png" class="logoblog">
					</div>
			</header>
			<section class="col-lg-4 position-center form-users">
				<div style="display: none;"><?php require 'includes\users.php';?></div>
				<?php 					 	
					if (!empty($message)) {
						echo '<p class="message-correcto">' . $message . ' <a href="login.php">Inicia sesión</a></p>';	
					}
					if (!empty($message2)) {
						echo '<p class="message-error">' . $message2 . '</p>';	
					}
				?>
				<form method="POST" action="">
					<div class="form-floating mt-2">
						<input class="align-input form-control" type="text" name="user" required id="floatingInput" placeholder="username">
						<label for="floatingInput"><span><i class="bi bi-person-fill"></i></span> Usuario</label>
					</div>
					<div class="form-floating">
						<input class="align-input form-control" type="email" name="correo" required id="floatingEmail" placeholder="Correo">
						<label for="floatingEmail"><i class="bi bi-envelope-fill"></i> Correo</label>
					</div>
					<div class="form-floating">
						<input class="align-input form-control" type="text" name="pregunta" value="mdjdojdo" id="floatingPregunta" placeholder="question" readonly="readonly">
						<label for="floatingPregunta"><i class="bi bi-question-lg"></i> Pregunta de seguridad</label>				
					</div>
					<div class="form-floating">
						<input class="align-input form-control" type="text" name="respuesta" minlength="3" maxlength="20" required id="floatingResponse" placeholder="respuesta">
						<label for="floatingResponse"><i class="bi bi-chat-right-text-fill"></i> Respuesta</label>
					</div>
					<input class="button-submit align-input" type="submit" value="Continuar"> 
				</form>
				<p align="center">¿No tienes una cuenta? <a href="sign_up.php">Regístrate</a></p>
			</section>
		</content>
	</div>
</body>
	<script src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>
</html>
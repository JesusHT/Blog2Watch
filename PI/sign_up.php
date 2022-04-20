<?php require 'includes\users.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="resources\style.css">
	<link rel="icon" type="image/png" href="Imagenes\icono.ico">
	<title>Blog2Watch</title>
</head>
<body class="body2">
	<div class="container">
		<content class="row" style="padding: 10px;">
			<section class="col-md-12">
				<div align="center">
					<img src="Imagenes/logoblog.png" class="logoblog">
				</div>
			</section>
			<section class="col-md-4 position-center form-users">
				<?php 
					if (!empty($message)) {
						echo '<p class="message-correcto">', $message ,'</p>';	
					}
					if (!empty($message2)) {
						echo '<p class="message-error">', $message2 ,'</p>';
					}
				?>
				<form method="POST" action="sign_up.php">
					<div class="form-floating mb-3">
						<input class="form-control" name="name" type="text" maxlength="20" minlength="5" required id="floatingInput" placeholder="user name">
						<label for="floatingInput"><span><i class="bi bi-person-fill"></i></span> Usuario</label>
					</div>
					<div class="form-floating">
						<input class="form-control" id="pass" type="password" name="pass" minlength="6" maxlength="20" required id="floatingPassword" placeholder="Password">
						<label for="floatingPassword"><span><i class="bi bi-lock-fill"></i></span> Contraseña <p class="coincide" id="demo"></label>
					</div>
					<div class="form-floating">
						<input class="form-control" id="pass-confirm" type="password" name="pass-confirm" minlength="6" maxlength="20" required id="floatingPassword" placeholder="Password">
						<label for="floatingPassword"><span><i class="bi bi-lock-fill"></i></span> Confirmar contraseña <p class="coincide" id="demo2"></p></label>
					</div>	
					<div class="form-floating">
						<select class="form-select align-input" id="floatingSelect" aria-label="Floating label select example" name="pregunta" required>
							<option>Elija una pregunta</option>
							<option value="¿Cuál es el nombre de mi mascota?">¿Cuál es el nombre de mi mascota?</option>
							<option value="¿Cuál es mi canción favorita?">¿Cuál es mi canción favorita?</option>
							<option value="¿Cuál es mi videojuego favorito?">¿Cuál es mi videojuego favorito?</option>
						</select>
						<label for="floatingSelect"><i class="bi bi-question-lg"></i> Pregunta de seguridad</label>				
					</div>
					<div class="form-floating">
						<input class="form-control" type="text" name="respuesta" minlength="3" maxlength="20" required id="floatingResponse" placeholder="respuesta">
						<label for="floatingResponse"><i class="bi bi-chat-right-text-fill"></i> Respuesta</label>
					</div>							
					<terminos>
						<input type="checkbox" name="terms" required><span> Acepto terminos y condiciones. </span><a href="javascript:to_open()">ver más</a>
					</terminos>
					<input class="button-submit align-input" type="submit" value="Registrar"> 
				</form>
				<p align="center">¿Ya tienes un cuenta? <a href="login.php">Inicia sesión</a></p>
			</section>
		</content>
	</div>
	<div class="ventana-terms terms" id="vent">
		<div class="row">
			<div class="col-md-10">
				<p>Terminos y Condiciones</p>
			</div>
			<div class="col-md-2">
				<a href="javascript:close()" class="cerrar"><i class="bi bi-x-circle-fill"></i></a>
			</div>
		</div>
		<p><!--INGRESAR AQUÍ LOS TERMINOS--></p>
	</div>
	<script src="resources/script.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>
</body>
</html>
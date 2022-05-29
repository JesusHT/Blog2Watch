<?php require 'includes\users.php';?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
	<link rel="stylesheet" type="text/css" href="resources\css\style.css">
	<link rel="icon" type="image/png" href="resources\img\icono.ico">
	<title>Blog2Watch</title>
</head>
<body class="body2">
	<div class="container">
		<content class="row p-2">
			<!-- Cabezera -->
			<header class="col-lg-12">
					<div class="logo justify-content-center row"><img src="resources/img/logoblog.png"></div>
			</header>
			<!-- Contenido -->
			<section class="col-lg-4 position-center rounded bg-gray p-4">
				<?php if (!empty($message)) echo $message;?>
				<form method="POST" action="login.php">
					<div class="form-floating mb-3">
						<input class="align-input form-control" type="text" name="name" required id="floatingInput" placeholder="username">
						<label for="floatingInput"><span><i class="fa-solid fa-user"></i></span> Usuario</label>
					</div>
					<div class="form-floating mb-2">
						<input class="align-input form-control" type="password" name="pass" id="pass" id="floatingPassword" placeholder="..." required>
						<label for="floatingPassword"><span><i class="fa-solid fa-lock"></i></span> Contraseña</label>
					</div>
					<input type="checkbox" id="eye" name="eye" class="mb-3"><label for="eye" class="text-white p-1">Mostrar contraseña</label>
					<input class="button-submit  align-input mb-3 text-white" type="submit" value="Ingresar"> 
				</form>
				<p class="text-center text-white">¿No tienes una cuenta? <a href="sign_up.php">Regístrate</a><br>¿Se te olvidó tu contraseña? <a href="recuperar.php">Recuperar</a></p>
			</section>
		</content>
	</div>
	<!-- Scripts -->
	<script src="resources/js/ver.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>
</body>
</html>
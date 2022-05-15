<?php require 'includes\users.php';?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="resources\css\style.css">
	<link rel="icon" type="image/png" href="resources\pictures\icono.ico">
	<title>Blog2Watch</title>
</head>
<body class="body2">
	<div class="container">
		<content class="row p-2">
			<header class="col-lg-12">
					<div class="logo justify-content-center row"><img src="resources/pictures/logoblog.png"></div>
			</header>
			<section class="col-lg-4 position-center rounded bg-gray p-4">
				<?php 					 	
					if (!empty($message)) {
						echo '<p class="bg-red fw-bold text-white p-1">' . $message . '</p>';
					}
				?>
				<form method="POST" action="login.php">
					<div class="form-floating mb-3">
						<input class="align-input form-control" type="text" name="name" required id="floatingInput" placeholder="username">
						<label for="floatingInput"><span><i class="bi bi-person-fill"></i></span> Usuario</label>
					</div>
					<div class="form-floating mb-3">
						<input class="align-input form-control" type="password" name="pass" required id="floatingPassword" placeholder="Password">
						<label for="floatingPassword"><span><i class="bi bi-lock-fill"></i></span> Contraseña</label>
					</div>
					<input class="button-submit  align-input mb-3 text-white" type="submit" value="Ingresar"> 
				</form>
				<p class="text-center text-white">¿No tienes una cuenta? <a href="sign_up.php">Regístrate</a><br>¿Se te olvidó tu contraseña? <a href="recuperar.php">Recuperar</a></p>
			</section>
		</content>
	</div>
	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="resources\css\style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<link rel="icon" type="image/png" href="resources\pictures\icono.ico">
	<title>Blog2Watch</title>
</head>
<body class="body2">
	<div class="container">
		<content class="row p-2">
			<header class="col-lg-12">
				<div class="logo justify-content-center row"><img src="resources/pictures/logoblog.png"></div>
			</header>
			<section class="col-lg-4 position-center bg-gray p-4 rounded">
				<div style="display: none;"><?php require 'includes\users.php';?></div>
				<?php 				
					if (!empty($message)) {
						echo '<p class="bg-green fw-bold text-white p-1">' . $message . ' <a href="login.php">Inicia sesión</a></p>';	
					}
					if (!empty($message2)) {
						echo '<p class="bg-red fw-bold text-white p-1">' . $message2 . '</p>';	
					}
				?>
				<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                    <div class="form-floating mt-2 mb-3">
                        <input class="align-input form-control" type="text" name="user2" value="<?php if(isset($_COOKIE['user'])){echo $users['name'];}?>"  maxlength="20" minlength="5" required id="floatingInput" placeholder="username" readonly="readonly">
                        <label for="floatingInput"><span><i class="bi bi-person-fill"></i></span> Usuario</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="align-input form-control" type="email" name="correo" required id="floatingEmail" placeholder="Correo">
                        <label for="floatingEmail"><i class="bi bi-envelope-fill"></i> Correo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="align-input form-control" type="text" name="pregunta" value="<?php if(isset($_COOKIE['user'])){echo $users['pregunta'];}?>" id="floatingPregunta" placeholder="question" readonly="readonly">
                        <label for="floatingPregunta"><i class="bi bi-question-lg"></i> Pregunta de seguridad</label>				
                    </div>
                    <div class="form-floating mb-3">
                        <input class="align-input form-control" type="text" name="respuesta" minlength="3" maxlength="20" required id="floatingResponse" placeholder="respuesta">
                        <label for="floatingResponse"><i class="bi bi-chat-right-text-fill"></i> Respuesta</label>
                    </div>
                    <input class="button-submit align-input mb-3 text-white" type="submit" value="Continuar"> 
                </form>
				<p class="text-white text-center">¿No tienes una cuenta? <a href="sign_up.php">Regístrate</a><br>Regresar <a href="login.php">Inicia sesión</a></p>
			</section>
		</content>
	</div>
</body>
	<script src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>
</html>
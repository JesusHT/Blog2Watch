<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
	<link rel="stylesheet" type="text/css" href="resources\css\style.css">
	<link rel="icon" type="image/png" href="resources\pictures\icono.ico">
	<title>Blog2Watch</title>
</head>
<body class="body2">
	<div class="container">
		<content class="row p-2">
			<!-- Encabezado -->
			<header class="col-lg-12">
				<div class="logo justify-content-center row"><img src="resources/pictures/logoblog.png"></div>
			</header>
			<!-- Contenido -->
			<section class="col-lg-4 position-center bg-gray p-4 rounded">
				<div style="display: none;"><?php require 'includes\users.php';?></div>
				<?php 				
					if (!empty($message)){ echo $message; }
				?>
				<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                    <div class="form-floating mt-2 mb-3">
                        <input class="align-input form-control" type="text" name="user2" value="<?php if(isset($_COOKIE['user'])){echo $users['name'];}?>"  maxlength="20" minlength="5" required id="floatingInput" placeholder="username" readonly="readonly">
                        <label for="floatingInput"><span><i class="fa-solid fa-user"></i></span> Usuario</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="align-input form-control" type="email" name="correo" required id="floatingEmail" placeholder="Correo">
                        <label for="floatingEmail"><i class="fa-solid fa-envelope"></i> Correo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="align-input form-control" type="text" name="pregunta" value="<?php if(isset($_COOKIE['user'])){echo $preguntas[$users['pregunta']];}?>" id="floatingPregunta" placeholder="question" readonly="readonly">
                        <label for="floatingPregunta"><i class="fa-solid fa-block-question"></i> Pregunta de seguridad</label>				
                    </div>
                    <div class="form-floating mb-3">
                        <input class="align-input form-control" type="text" name="respuesta" minlength="3" maxlength="20" required id="floatingResponse" placeholder="respuesta">
                        <label for="floatingResponse"><i class="fa-thin fa-comment-minus"></i> Respuesta</label>
                    </div>
                    <input class="button-submit align-input mb-3 text-white" type="submit" value="Continuar"> 
                </form>
				<p class="text-white text-center">¿No tienes una cuenta? <a href="sign_up.php">Regístrate</a><br><a href="login.php">Regresar</a></p>
			</section>
		</content>
	</div>
	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>
</body>
</html>
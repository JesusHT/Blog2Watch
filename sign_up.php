<?php require './includes/users.php'; ?>

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
			<!-- Encabezado -->
			<section class="col-md-12">
				<div class="logo justify-content-center row"><img src="resources/img/logoblog.png"></div>
			</section>
			<!-- Contenido -->
			<section class="col-md-4 col-sm-4 position-center rounded bg-gray p-4">
				<?php if (!empty($message)) echo $message; ?>
				<form method="POST" action="sign_up.php">
					<div class="form-floating mb-3">
						<input class="form-control" name="name" type="text" maxlength="20" minlength="5" required id="floatingInput" placeholder="user name">
						<label for="floatingInput"><span><i class="fa-solid fa-user"></i></span> Usuario</label>
					</div>
					<div class="form-floating mb-3">
						<input class="form-control" id="pass" type="password" name="pass" minlength="6" maxlength="20" required id="floatingPassword" placeholder="Password">
						<label for="floatingPassword"><span><i class="fa-solid fa-lock-keyhole"></i></span> Contraseña <span id="demo"></span></label>
					</div>
					<div class="form-floating mb-3">
						<input class="form-control" id="pass-confirm" type="password" name="pass-confirm" minlength="6" maxlength="20" required id="floatingPassword" placeholder="Password">
						<label for="floatingPassword"><span><i class="fa-solid fa-lock-keyhole"></i></span> Confirmar contraseña <span id="demo2"></span></label>
					</div>	
					<div class="form-floating mb-3">
						<select class="form-select align-input" id="floatingSelect" aria-label="Floating label select example" name="pregunta" required>
							<option selected disabled>Elija una pregunta</option>
							<option value="1">¿Cuál es el nombre de mi mascota?</option>
							<option value="2">¿Cuál es mi canción favorita?</option>
							<option value="3">¿Cuál es mi videojuego favorito?</option>
						</select>
						<label for="floatingSelect"><i class="fa-solid fa-block-question"></i> Pregunta de seguridad</label>				
					</div>
					<div class="form-floating mb-3">
						<input class="form-control" type="text" name="respuesta" minlength="3" maxlength="20" required id="floatingResponse" placeholder="respuesta">
						<label for="floatingResponse"><i class="fa-thin fa-comment-minus"></i> Respuesta</label>
					</div>							
					<terminos class="text-white">
						<input type="checkbox" name="terms" id="terms" required> 
						<label for="terms">Acepto terminos y condiciones.</label> 
						<a data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="pointer">ver más</a>
					</terminos>
					<input class="button-submit align-input text-white mb-3 mt-2" type="submit" value="Registrar"> 
				</form>
				<p class="text-center text-white">¿Ya tienes un cuenta? <span><a href="login.php">Inicia sesión</a></span></p>
			</section>
		</content>
	</div>
	<!-- Modal terminos -->
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
		 	<div class="modal-content bg-gray text-white p-2">
				<div class="modal-header">
					<h5 class="modal-title fw-bold" id="staticBackdropLabel">TÉRMINOS Y CONDICIONES</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body bg-darkGray txt-justify">
					<!-- <p>Aquí van los terminos </p> -->
					Al acceder y utilizar este servicio, usted acepta y accede a estar obligado por los términos y disposiciones de este acuerdo. 
					Asimismo, al utilizar estos servicios particulares, usted estará sujeto a toda regla o guía de uso correspondiente que se haya publicado para dichos servicios. 
					Toda participación en este servicio constituirá la aceptación de este acuerdo. Si no acepta cumplir con lo anterior, por favor, no lo utilice.<br><br>

					Esta página web no utiliza ningún método de cobro o pago, su uso es gratuito y la suscripción al servicio no tiene costo monetario alguno. <br><br>

					El producto o servicio al que usted se suscribirá tiene únicamente fines recreativos y de entretenimiento. 
					La página cuenta con recomendaciones de series y películas con 4 diferentes plataformas de streaming (Netfliz, Disney +, Amazon Prime Video y HBO Max) 
					para que el usuario decida sobre el texto el contenido para su propio entretenimiento.<br><br>
					
					La presente página web puede ser utilizada por todo público, no se incluye contenido violento o sexual por lo que es clasificado para todas las edades. 
					Blog2Watch se deslinda de los menores de edad que tengan ciertas prohibiciones incluídas nuestra página, cada miembro que se suscribe concuerda en aceptar estos 
					Términos y Condiciones, asímismo, no tenemos los derechos sobre ningún material audiovisual, únicamente se presentan recomendaciones sobre visualizarlas o no.<br>
				</div>
			</div>
		</div>
	</div>
	<!-- Scripts -->
	<script src="resources/js/validar.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>
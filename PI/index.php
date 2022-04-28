<?php require 'includes\sesion.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="resources\css\stylePlataformas.css">
	<link rel="stylesheet" type="text/css" href="resources\css\style.css">
	<link rel="stylesheet" type="text/css" href="resources\css\styleNav.css">
	<link rel="icon" type="image/png" href="Imagenes\icono.ico">
	<title>Blog2Watch</title>
</head>
<body>
	<div class="container">
		<div class="site-sidebar"> 
			<nav class="scroller gif"><div id="menu"><!-- Plataformas --> </div></nav>
		</div>
		<header>
			<div class="col-lg-8 position-center logo" align="center">
				<img src="Imagenes\logoblog.png">
			</div>
		</header>
		<nav class="nav justify-content-center navbar-dark mb-3 col-lg-8 position-center row">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="bi bi-house-door-fill"></i> Home</button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" id="acercaDe-tab" data-bs-toggle="tab" data-bs-target="#acercaDe" type="button" role="tab" aria-controls="acercaDe" aria-selected="false"><i class="bi bi-info-circle-fill"></i> Acerca De</button>
				</li>
				<li class="nav-item col-4">
					<button class="nav-link" type="button" onclick="location.href='login.php'"><i class="bi bi-person-fill"></i> Inicio de sesion </button>
				</li>
			</ul>
		</nav>
		<content>
			<div class="container-fluid">
				<content class="row">
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<section class="col-lg-8 position-center mb-3">
								<?php require 'includes\filtros.php'; ?>
							</section>
							<section class="col-lg-8 position-center">
								<?php 
									if($query -> rowCount() > 0) { 
										foreach($results as $result) {
								?>
											<post class="row post">
												<div class="col-lg-12 mt-2">
													<post-title><h3><?php echo $result -> titulo; ?></h3></post-title>
												</div>
												<post-info class="info-post mt-2"><p><?php echo $result -> info; ?></p></post-info>
												<post-reactions>
												</post-reactions>
												<post-comment class="col-lg-12">
													<div class="row">
														<div class="col-lg-12">
															<div class="content-comment mb-2">
																<p class="text-name-comment"><?php  ?></p><p class="text-comment"><?php  ?></p>
															</div>
														</div>
														<div class="col-lg-12">
															<div class="row">
																<form method="POST" class="btn-group mb-3" action="javascript:to_open()">
																	<input type="hidden" name="eliminar" value="<?php echo $result -> id_post; ?>">
																	<textarea class="col-lg-10 textarea-comment" type="text" name="comment" placeholder="Escribir comentario..."></textarea>
																	<input class="col-lg-2 submit-comment" type="submit" value="Comentar">
																</form>
															</div>
														</div>
													</div>
												</post-comment>
											</post>
											<br>
								<?php
										} 
									}

								?>
							</section>
						</div>
						<div class="tab-pane fade" id="acercaDe" role="tabpanel" aria-labelledby="acercaDe-tab">...</div>
					</div>
				</content>
			</div>
		</content>
		<buzon class="mailbox">
			<a href="javascript:to_open()"><img src="Imagenes\buzon1.png"></a>
		</buzon>
		<aviso-visitante class="ventana-aviso-visitante" id="vent">
			<h5 class="title-aviso">AVISO</h5>
			<input type="button" id="cerrar" hidden><label for="cerrar"><a href="javascript:close()"><i class="bi bi-x-circle-fill"></i></a></label>
			<body-visitante class="row">
				<div class="contenido-aviso">
					<p align="center">Si quieres disfrutar de los privilegios:</p>
					<div class="row">
						<div class="col-6 col-sm-4" align="right">
							<i class="bi bi-chat-right-text-fill"></i><br>
							<i class="bi bi-emoji-smile"></i><i class="bi bi-emoji-frown"></i><br>
							<i class="bi bi-mailbox"></i>
						</div>
						<div class="col-6 col-sm-4">
							<p>Comentar</p>
							<p>Reaccionar</p>
							<p>Entrar al Buzón</p>
						</div>
						<div class="col-12 mb-3" align="center">
							<p>Registrate a nuestro blog o inicia sesión</p>
							<a href="sign_up.php"><button class="buttons-aviso">Registrarse</button></a>
							<a href="login.php"><button class="buttons-aviso">Inicia Sesión</button></a>					
						</div>	
					</div>
				</div>		
			</body-visitante>
		</aviso-visitante>
	</div>
	<script src="resources/js/script.js"></script>
	<script src="resources/js/plataformas.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/ulg/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>
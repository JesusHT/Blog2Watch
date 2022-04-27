<?php require 'includes\sesion.php' ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="resources\css\style.css">
	<link rel="stylesheet" type="text/css" href="resources\css\styleNav.css">
	<link rel="icon" type="image/png" href="Imagenes\icono.ico">
	<title>Blog2Watch</title>
</head>
<body class="body">
	<div class="container">
		<header>
			<div class="col-md-8 position-center logo" align="center">
				<img src="Imagenes\logoblog.png">
			</div>
		</header>
		<nav class="nav justify-content-center navbar-dark mb-3 col-md-8 position-center row">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="bi bi-house-door-fill"></i> Home</button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="bi bi-info-circle-fill"></i> Acerca De</button>
				</li>
				<li class="nav-item col-4 dropdown">
					<button class="nav-link " type="button"><i class="bi bi-person-fill"></i> <?php if (!empty($user)){ echo $user['name']; } ?></button>
						<div class="dropdown-content">
					    <a href="#">Cambiar Contraseña</a>					
					    <a href="logout.php">Cerrar Sesión</a>
					  </div>
				</li>
			</ul>
		</nav>
		<content>
			<div class="container">
				<content class="row">
					<section class="col-md-8 position-center mb-3">
						<?php require 'includes\filtros.php'; ?>
					</section>
					<section class="col-md-8 position-center">
					<?php 
							if($query -> rowCount() > 0) { 
								foreach($results as $result) {
						?>
									<post class="row post">
										<div class="col-md-12 mt-2">
											<post-title class="title-post"><h3><?php echo $result -> titulo; ?></h3></post-title>
										</div>
										<post-info class="info-post mt-2"><p><?php echo $result -> info; ?></p></post-info>
										<post-reactions>
										</post-reactions>
										<post-comment class="col-md-12">
											<div class="row">
												<div class="col-md-12">
													<div class="content-comment mb-2">
														<p class="text-name-comment"><?php  ?></p><p class="text-comment"><?php  ?></p>
													</div>
												</div>
												<div class="col-md-12">
													<div class="row">
														<form method="POST" class="btn-group mb-3" action="index-administrador.php">
															<input type="hidden" name="eliminar" value="<?php echo $result -> id_post; ?>">
															<textarea class="col-md-10 textarea-comment" type="text" name="comment" placeholder="Escribir comentario..."></textarea>
															<input class="col-md-2 submit-comment" type="submit" value="Comentar">
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
				</content>
			</div>
		</content>
		<buzon class="mailbox">
			<a class="mailbox2"><img src="Imagenes\buzon.png" id="mailbox-open"></a>
			<a href="javascript:to_open()"><img src="Imagenes\buzon1.png" id="mailbox-closed"></a>
		</buzon>
		<buzon-abierto class="ventana-mailbox" id="vent">
			<h5 class="title-mailbox">BUZÓN DE SUGERENCIAS</h5>
			<cerrar id="close">
				<a href="javascript:close()"><img src="Imagenes/error.png" width="25" height="25" align="right"></a>
			</cerrar>
			<br><br>
			<body-mailbox class="row">
				<div class="mailbox-chat">
						<div class="row">
							<div class="col-md-6">
								<p class="text-name-mailbox">Adiministrador</p>
								<p class="text-mailbox">Mensage</p>
							</div>
							<div class="col-md-6"></div>
							<div class="col-md-6"></div>
							<div class="col-md-6">
								<p class="text-name-mailbox">Usuario</p>
								<p class="text-mailbox">Mensage</p>
							</div>
						</div>
				</div>
				<form class="btn-group" method="POST" action="#">
					<textarea class="col-md-10 textarea-mailbox" type="text" name="mailbox" placeholder="Escribir sugerencia..."></textarea>
					<input class="col-md-2 submit-mailbox" type="submit" value="Enviar">
				</form>
			</body-mailbox>
		</buzon-abierto>
	</div>
	<script src="resources/js/script.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>
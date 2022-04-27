<?php require 'includes/sesion.php'; require 'includes/administrador.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
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
					<button class="nav-link" type="button"><i class="bi bi-person-fill"></i> <?php if (!empty($user)){ echo $user['name']; } ?></button>
					<div class="dropdown-content">
					    <a class="dropdown-item " id="perfil-tab" data-bs-toggle="pill" data-bs-target="#perfil" type="button" role="tab" aria-controls="perfil" aria-selected="false" >Perfil</a>					
					    <a class="dropdown-item " id="buzo-tab" data-bs-toggle="pill" data-bs-target="#buzon" type="button" role="tab" aria-controls="buzon" aria-selected="false" >Buzón</a>					
					    <a class="dropdown-item" href="logout.php">Cerrar Sesión</a>
					 </div>
				</li>
			</ul>
		</nav>
		<content>
			<div class="container-fluid">
				<content class="row">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<section class="col-md-8 position-center mb-3">
							<?php require 'includes\filtros.php'; ?>
						</section>
						<section class="col-md-8 position-center">
							<post-form class="row post">
								<div class="mt-3">
									<?php 
										if (!empty($message)) {
											echo '<p class="message-correcto2">', $message ,'</p>';	
										}
										if (!empty($message2)) {
											echo '<p class="message-error2">', $message2 ,'</p>';
										}
									?>
								</div>
								<form class="margin-bottom font" action="index-administrador.php" method="POST" id="formul"> 
										<label>Ingrese Titulo</label>
										<input class="align-input2" type="text" name="title" maxlength="100" required>
										<label>Ingrese Información</label>
										<textarea name="info" class="info-textarea" minlength="6" maxlength="500" required></textarea>
										<label>Seleccione Plataforma</label>
										<select class="align-input2" name="plataforma" required>
										  <option value="NETFLIX">Netflix</option>
										  <option value="Amazon">Amazon Prime</option>
										  <option value="Disney">Disney+</option>
										  <option value="HBO">HBO</option>
										  <option value="Otro">Otro</option>
										</select>
										<label>Seleccione Tipo</label>
										<select class="align-input2" name="tipo" required>
										  <option value="Pelicula">Pelicula</option>
										  <option value="Serie">Serie</option>
										</select>
										<input class="button-submit2 align-input" type="submit">
								</form>
							</post-form>	
							<br>
							<?php 
								if($query -> rowCount() > 0) { 
									foreach($results as $result) {
							?>
										<post class="row post">
											<div class="col-md-12 mt-2">
												<div class="row">
													<div class="col-md-10">
														<post-title class="title-post"><h3><?php echo $result -> titulo; ?></h3></post-title>
													</div>
													<div class="col-md-2" align="right">
														<form action="index-administrador.php" method="POST">
															<input type="hidden" name="eliminar" value="<?php echo $result -> id_post; ?>">
															<button type="submit"><i class="bi bi-trash-fill"></i></button>								
														</form>
													</div>
												</div>
											</div>
											<post-info class="info-post mt-2"><p><?php echo $result -> info; ?></p></post-info>
											<post-reactions class="reactions-post position-center mb-3">
												
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
					</div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
					<div class="tab-pane fade" id="perfil" role="tabpanel" aria-labelledby="perfil-tab">...</div>
					<div class="tab-pane fade" id="buzon" role="tabpanel" aria-labelledby="buzon-tab">...</div>
				</content>
			</div>
		</content>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>

								

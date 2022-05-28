<?php require 'includes\publicaciones.php';?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
	<link rel="stylesheet" type="text/css" href="resources\css\stylePlataformas.css">
	<link rel="stylesheet" type="text/css" href="resources\css\styleNav.css">
  	<link rel="stylesheet" type="text/css" href="resources\css\style.css">
	<link rel="icon" type="image/png" href="resources\pictures\icono.ico">
	<title>Blog2Watch</title>
</head>
<body>
	<div class="container">
		<!-- Menú de plataformas -->
		<div class="site-sidebar"> 
			<nav class="scroller gif"><div id="menu"><!-- Plataformas --> </div></nav>
		</div>
		<!-- Encabezado -->
		<header>
			<div class="col-md-8 position-center logo justify-content-center row"><img src="resources/pictures/logoblog.png"></div>
		</header>
		<!-- Menú -->
		<nav class="nav justify-content-center navbar-dark mb-3 col-md-8 position-center row">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="fa-solid fa-house"></i>  Home</button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" id="acercaDe-tab" data-bs-toggle="tab" data-bs-target="#acercaDe" type="button" role="tab" aria-controls="acercaDe" aria-selected="false"><i class="fa-solid fa-circle-info"></i> Acerca De</button>
				</li>
				<li class="nav-item col-4">
					<button class="nav-link" type="button" onclick="location.href='login.php'"><i class="fa-solid fa-user"></i> Inicio de sesion </button>
				</li>
			</ul>
		</nav>
		<!-- Contenido -->
		<div class="container">
			<content class="row">
				<div class="tab-content" id="myTabContent">
					<!-- Pestaña de inicio -->
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<!-- Publicaciones -->
						<section class="col-md-8 col-sm-4 position-center container">
						<?php 
									if($query -> rowCount() > 0) { 
										foreach($publicaciones as $publicacion) {
								?>
											<post class="row border rounded-3 mb-3 position-center" style="border-color: <?php echo $bg[$publicacion -> plataforma - 1]; ?>!important;">
												<!-- Titulo -->
												<div class="col-md-12 mt-2"><h3 class="text-white fw-bold"><?php echo  $publicacion-> titulo; ?></h3></div>
												<!-- Información -->
												<post-info class="info-post mt-2 col-md-12 text-white"><p><?php echo  $publicacion-> info ?></p></post-info>
												<!-- Calificación -->
												<label>
												<?php
													for ($i=0; $i < $publicacion -> calificacion; $i++) { 
														echo '<i class="fa-solid fa-popcorn '. $colors[$publicacion -> plataforma - 1].'"></i>';
													}
												?>
												</label>
												<!-- Comentarios -->
												<post-comment class="col-md-12">
													<div class="col-md-12">
														<div class="body-comment mb-2 text-white">
															<?php 
																$comentarios = mostrarCom($publicacion -> id_post);
																if (!empty($comentarios)) {
																	foreach($comentarios as $comentario) {?>
																		<p class="text-name-comment"><?php echo $comentario -> name; ?></p>
																		<p class="text-comment"><?php echo $comentario -> comment;  ?></p>
															<?php 	}
																}
															?>
														</div>
													</div>
													<form id="formComment<?php echo  $publicacion -> id_post; ?>">
														<div class="input-group mb-3">
															<textarea type="text" name="comment" id="comment<?php echo  $publicacion-> id_post; ?>" class="form-control h-comment bg-dark text-white" placeholder="Escribir comentario..." ></textarea>
															<button type="button" class="btn btn-outline-secondary submit-comment text-white" onclick="limpiar(<?php echo  $publicacion -> id_post; ?>)" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
																<i class="fa-solid fa-message"></i>
															</button>
														</div>
													</form>
												</post-comment>
											</post>
								<?php
										} 
									}

								?>
						</section>
					</div>
					<!-- Pestaña acerca de -->
					<div class="tab-pane fade" id="acercaDe" role="tabpanel" aria-labelledby="acercaDe-tab">
						<section class="col-md-8 col-sm-4 position-center"><?php require 'includes/acercaDe.php'; ?></section>
					</div>
				</div>
			</content>
		</div>
		<!-- Button trigger modal -->
		<div class="mailbox" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
		  	<img src="resources/pictures/buzon1.png" >
		</div>
		<!-- Modal -->
		<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content bg-gray text-white p-2">
		        <div class="modal-header">
		        	<h5 class="modal-title fw-bold" id="staticBackdropLabel">AVISO</h5>
		        	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      	</div>
		      	<div class="modal-body bg-darkGray">
		        	<p class="text-center">Si quieres disfrutar los privilegios:</p>
					<div class="col-md-12 mb-2" >
						<div class="row g-2">
							<div class="col-6">
								<h5 class="float-end"><i class="fa-solid fa-message"></i><br><i class="fa-solid fa-mailbox"></i></h5>
							</div>
							<div class="col-6">
								<h5>Comentar<br>Buzón</h4>
							</div>
						</div>
					</div>
					<div class="col-md-12 mb-3 text-center">
						<p>Registrate o inicia sesión en nuestro blog</p>
						<button class="buttons-aviso"><a href="sign_up.php" class="text-white">Registrarse</a></button>
						<button class="buttons-aviso"><a href="login.php" class="text-white">Iniciar sesión</a></button>		
					</div>
		       	</div>
		    </div>
		  </div>
		</div>
	</div>
	<!-- Scripts -->
	<script src="resources/js/appVisitante.js"></script>
	<script src="resources/js/plataformas.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script> -->
</body>
</html>
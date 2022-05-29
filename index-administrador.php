<?php require 'includes/sesion.php'; require 'includes/administrador.php'; require 'includes/publicaciones.php' ?>

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
	<link rel="icon" type="image/png" href="resources\img\icono.ico">
	<title>Blog2Watch</title>
</head>
<body>
	<div class="container">
		<!-- Menú de plataformas -->
		<div class="site-sidebar"> 
			<nav class="scroller gif"><div><?php require 'views/plataformas.php'; ?></div></nav>
		</div>
		<!-- Encabezado -->
		<header>
			<div class="col-md-8 position-center logo justify-content-center row"><img src="resources\img\logoblog.png"></div>
		</header>
		<!-- Menú -->
		<nav class="nav justify-content-center navbar-dark mb-3 col-md-8 position-center row">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="fa-solid fa-house"></i> Inicio</button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" id="acercaDe-tab" data-bs-toggle="tab" data-bs-target="#acercaDe" type="button" role="tab" aria-controls="acercaDe" aria-selected="false"><i class="fa-solid fa-circle-info"></i> Acerca De</button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" id="perfil-tab" data-bs-toggle="tab" data-bs-target="#perfil" type="button" role="tab" aria-controls="perfil" aria-selected="false"><i class="fa-solid fa-user"></i> <?php if (!empty($user)){ echo $user['name']; } ?></button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" id="buzon-tab" data-bs-toggle="tab" data-bs-target="#buzon" type="button" role="tab" aria-controls="buzon" aria-selected="false"><i class="fa-solid fa-mailbox"></i> Buzón</button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="users" role="tab" aria-controls="users" aria-selected="false"><i class="fa-solid fa-users"></i> Usuarios</button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" type="button" onclick="location.href='includes/logout.php'"><i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar Sesión</button>
				</li>
			</ul>
		</nav>
		<!-- Contenido -->
		<div class="container">
			<content class="row">
				<div class="tab-content" id="myTabContent">	
					<!-- Pestaña de inicio  -->	
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<section class="col-md-8 col-sm-4 position-center">
							<post-form class="row border rounded-3 border-white mb-3 position-center mb-3 text-white">
								<div class="mt-3"> <?php if (!empty($message)) echo $message; ?> </div>
								<!--Form Publicaciones-->
								<form action="index-administrador.php" method="POST" id="formul"> 
									<div class="form-floating mb-3">
										<input type="text" class="form-control bg-dark text-white" id="floatingInput" placeholder="title" name="title" maxlength="100" required>
										<label for="floatingInput">Título</label>
									</div>

									<div class="form-floating mb-3 ">
										<textarea type="text" class="form-control bg-dark text-white" style="height: 100px" id="floatingInput" placeholder="info" name="info"  minlength="6" maxlength="500" required></textarea>
										<label for="floatingInput">Información</label>
									</div>

									<div class="row g-2">
										<div class="form-floating mb-3 col-6">
											<select class="form-select bg-dark text-white"  id="floatingSelect" aria-label="Floating label select example" name="plataforma" required>
												<option selected disabled>Elija una plataforma</option>
												<option value="1">Netflix</option>
												<option value="2">Amazon Prime</option>
												<option value="3">Disney+</option>
												<option value="4">HBO</option>
												<option value="5">Otro</option>
											</select>
											<label for="floatingSelect">Plataforma</label>	
										</div>

										<div class="form-floating mb-3 col-6">
											<select class="form-select bg-dark text-white" id="tipo" id="floatingSelect" aria-label="Floating label select example" name="tipo" required>
												<option selected disabled>Elija el tipo</option>
												<option value="2">Pelicula</option>
												<option value="1">Serie</option>
											</select>
											<label for="floatingSelect">Tipo</label>	
										</div>
									</div>
									<div class="row g-2">
										<div class="col-6 form-floating mb-3">
											<input type="number" name="extreno" class="form-control bg-dark text-white" max="2022" id="floatingInput" placeholder="..." required>
											<label for="floatingInput">Año de extreno</label>
										</div>
										<div class="col-6 form-floating mb-3" id="pelicula" style="display: none">
											<input class="form-control bg-dark text-white" name="duracion" type="text" id="floatingInput" placeholder="...">
											<label for="floatingInput">Duración</label>
										</div>
										<div class="col-6 form-floating mb-3" id="serie" style="display: none">
											<input class="form-control bg-dark text-white" name="duracion2" type="text" id="floatingInput" placeholder="...">
											<label for="floatingInput">Temporadas</label>
										</div>
									</div>
									<div class="form-floating mb-3">
										<input type="number" name="calificacion" min="0" max="5" id="floatingInput" class="form-control bg-dark text-white" placeholder="..." required>
										<label for="floatingInput">Calificación</label>
									</div>
									<input class="btn button-submit2 text-white mb-3 rounded border-white border-1" type="submit" value="Subir">
								</form>
							</post-form>
							<!-- publicaciones -->
							<?php if($query -> rowCount() > 0) { foreach($publicaciones as $publicacion) {?>
								<post class="row border rounded-3 mb-3 position-center" style="border-color: <?php echo $bg[$publicacion -> plataforma - 1]; ?>!important;">
									<!-- Titulo -->
									<div class="col-md-12 mt-2">
										<div class="row">
											<div class="col-md-12"> 
												<div class="row g-2">
													<div class="col-10">
														<h3  class="text-white fw-bold"><?php echo $publicacion -> titulo; ?></h3>
													</div>
													<div class="col-2 btn-group justify-content-end">
														<form action="index-administrador.php" method="POST" >
															<input type="hidden" name="eliminar" value="<?php echo $publicacion -> id_post; ?>">
															<button type="submit" class="submit bg-dark text-white"><i class="fa-solid fa-trash-can"></i></button>	
														</form>
														<form action="" method="POST" id="updatePost<?php echo $publicacion -> id_post; ?>">
															<input type="hidden" name="editar" value="<?php echo $publicacion -> id_post; ?>">
															<button type="button" class="submit bg-dark text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="updatePost(<?php echo $publicacion -> id_post; ?>)"><i class="fa-solid fa-pencil"></i></button>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
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
												<input type="hidden" name="user" id="user" value="<?php echo $user['name']; ?>">
												<input type="hidden" name="id_post" id="id_post" value="<?php echo  $publicacion -> id_post; ?>">
												<textarea type="text" name="comment" id="comment<?php echo  $publicacion-> id_post; ?>" class="form-control h-comment bg-dark text-white" placeholder="Escribir comentario..."></textarea>
												<button type="button" class="btn btn-outline-secondary submit-comment text-white" id="enviar" onclick="enviarDatos(<?php echo  $publicacion -> id_post; ?>)">
													<i class="fa-solid fa-message"></i>
												</button>
											</div>
										</form>
									</post-comment>
								</post>
							<?php } } ?>
						</section>
					</div>
					<!-- Pestaña Acerca De -->
					<div class="tab-pane fade" id="acercaDe" role="tabpanel" aria-labelledby="acercaDe-tab">
						<section class="col-md-8 col-sm-4 position-center"><?php require 'views\acercaDe.php'; ?></section>
					</div>
					<!-- Pestaña perfil -->
					<div class="tab-pane fade" id="perfil" role="tabpanel" aria-labelledby="perfil-tab">
						<section class="col-md-8 col-sm-4 position-center"><?php require 'views\profile.php'; ?></section>
					</div>
					<!-- Pestaña Buzón -->
					<div class="tab-pane fade" id="buzon" role="tabpanel" aria-labelledby="buzon-tab">
						<section class="col-md-8 col-sm-4 position-center">
							<div class="d-flex align-items-start">
								<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
									<?php 
										if($sqlComment -> rowCount() > 0) { 
											foreach($comments as $buzon) {
									?>
										<button class="btn nav-link <?php if($comments[0] -> users == $buzon -> users){echo 'active';}?>" id="user<?php echo $buzon -> id_buzon;?>-tab" data-bs-toggle="pill" data-bs-target="#user<?php echo $buzon -> id_buzon;?>" type="button" role="tab" aria-controls="user-<?php echo $buzon -> id_buzon;?>" aria-selected="<?php if($comments[0] -> users == $buzon -> mensaje){echo 'true';}?>"><?php echo $buzon -> users; ?></button>
									<?php
											} 
									?>
								</div>
								<div class="tab-content" id="v-pills-tabContent">
									<?php 
											foreach($comments as $buzon) {
									?>
										<div class="tab-pane fade <?php if($comments[0] -> users == $buzon -> users){echo 'show active';}?>" id="user<?php echo $buzon -> id_buzon;?>" role="tabpanel" aria-labelledby="user<?php echo $buzon -> id_buzon;?>-tab"><P class="text-white"><?php echo $buzon -> mensaje; ?></P></div>
									<?php
											} 
										}
									?>
								</div>
							</div>
						</section>
					</div>
					<!-- Pestaña Usuarios -->
					<div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
						<section class="col-md-8 col-sm-4 position-center">
							<input type="text" name="busqueda" id="busqueda" placeholder="Buscar..." class="bg-dark text-white">
							<table class="table table-dark mt-3">
								<thead>
									<tr>
										<td class="col">#</td>
										<td class="col-10">Usuario</td>
										<td class="col-2 text-center">Eliminar</td>
									</tr>
								</thead>
								<tbody id="tabla_resultado"></tbody>
							</table>
						</section>
					</div>
				</div>
				<!-- Modal -->
				<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content bg-gray text-white p-2">
							<div class="modal-header">
								<h5 class="modal-title fw-bold" id="staticBackdropLabel">EDITAR PUBLICACIÓN</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body bg-darkGray" id="editarPost"></div>
						</div>
					</div>
				</div>
			</content>
		</div>
	</div>
	<!-- Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="resources/js/appAdmin.js"></script>
	<script src="resources/js/validar.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>	
</body>
</html>
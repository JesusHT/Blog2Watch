<?php require '../includes/sesion.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
	<link rel="stylesheet" type="text/css" href="../resources\css\stylePlataformas.css">
	<link rel="stylesheet" type="text/css" href="../resources\css\reactions.css">
	<link rel="stylesheet" type="text/css" href="../resources\css\styleNav.css">
  	<link rel="stylesheet" type="text/css" href="../resources\css\style.css">
	<link rel="icon" type="image/png" href="../resources/img/icono.ico">
	<title>Blog2Watch</title>
</head>
<body>
	<div class="container">
		<!-- Plataformas -->
		<div class="site-sidebar"> 
			<nav class="scroller gif"><div><?php require '../views/plataformas.php'; ?></div></nav>
		</div>
		<!-- Encabezado -->
		<header>
			<div class="col-md-8 position-center logo justify-content-center row"><img src="../resources/img/logoblog.png"></div>
		</header>
		<!-- Menú -->
		<nav class="nav justify-content-center navbar-dark mb-3 col-md-8 position-center row">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="fa-solid fa-house"></i><br> Inicio</button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" id="acercaDe-tab" data-bs-toggle="tab" data-bs-target="#acercaDe" type="button" role="tab" aria-controls="acercaDe" aria-selected="false"><i class="fa-solid fa-circle-info"></i><br> Acerca De</button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" id="perfil-tab" data-bs-toggle="tab" data-bs-target="#perfil" type="button" role="tab" aria-controls="perfil" aria-selected="false"><i class="fa-solid fa-user"></i><br> <?php if (!empty($user)){ echo $user['name']; } ?></button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" id="buzon-tab" data-bs-toggle="tab" data-bs-target="#buzon" type="button" role="tab" aria-controls="buzon" aria-selected="false"><i class="fa-solid fa-mailbox"></i><br> Buzón</button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="users" role="tab" aria-controls="users" aria-selected="false"><i class="fa-solid fa-users"></i><br> Usuarios</button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" type="button" onclick="location.href='../includes/logout.php'"><i class="fa-solid fa-arrow-right-from-bracket"></i><br> Cerrar Sesión</button>
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
							<ul class="nav nav-pills mb-3 justify-content-end" id="pills-tab" role="tablist">
								<li class="nav-item" role="presentation">
									<button class="nav-link active" id="pills-homeAdmin-tab" data-bs-toggle="pill" data-bs-target="#pills-homeAdmin" type="button" role="tab" aria-controls="pills-homeAdmin" aria-selected="true"><i class="fa-solid fa-house"></i></button>
								</li>
								<li class="nav-item" role="presentation">
									<button class="nav-link" id="pills-verComo-tab" data-bs-toggle="pill" data-bs-target="#pills-verComo" type="button" role="tab" aria-controls="pills-verComo" aria-selected="false" title="Ver como usuario"><i class="fa-solid fa-eye"></i></button>
								</li>
							</ul>
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-homeAdmin" role="tabpanel" aria-labelledby="pills-homeAdmin-tab">
										<post-form class="row border rounded-3 border-white mb-3 position-center text-white">
										<!--Form Publicaciones-->
										<div id="respustaCrear" class="mt-2"></div>
										<form action="" id="crearPost" class="mt-1"> 
											<div class="form-floating mb-3">
												<input type="text" class="form-control bg-dark text-white" id="floatingInputTitulo" placeholder="title" name="title" maxlength="100" required>
												<label for="floatingInputTitulo">Título</label>
											</div>

											<div class="form-floating mb-3 ">
												<textarea type="text" class="form-control bg-dark text-white" style="height: 100px" id="floatingInputInformacion" placeholder="info" name="info"  minlength="6" required></textarea>
												<label for="floatingInputInformacion">Información</label>
											</div>

											<div class="row g-2">
												<div class="form-floating mb-3 col-6">
													<select class="form-select bg-dark text-white"  id="floatingSelectPlataforma" aria-label="Floating label select example" name="plataforma" required>
														<option value="" selected>Elija una plataforma</option>
														<option value="1">Netflix</option>
														<option value="2">Amazon Prime</option>
														<option value="3">Disney+</option>
														<option value="4">HBO</option>
													</select>
													<label for="floatingSelectPlataforma">Plataforma</label>	
												</div>

												<div class="form-floating mb-3 col-6">
													<select class="form-select bg-dark text-white" id="tipo" id="floatingSelectTipo" aria-label="Floating label select example" name="tipo" required>
														<option value="" selected >Elija el tipo</option>
														<option value="2">Pelicula</option>
														<option value="1">Serie</option>
													</select>
													<label for="floatingSelectTipo">Tipo</label>	
												</div>
											</div>
											<div class="row g-2">
												<div class="col-6 form-floating mb-3">
													<input type="number" name="extreno" class="form-control bg-dark text-white" max="2022" id="floatingInputExtreno" placeholder="..." required>
													<label for="floatingInputExtreno">Año de estreno</label>
												</div>
												<div class="col-6 form-floating mb-3">
													<input class="form-control bg-dark text-white" name="duracion" type="number" id="floatingInputDuracion" placeholder="...">
													<label for="floatingInputDuracion">Duración(min) o Temporadas</label>
												</div>
											</div>
											<button type="button" class="btn button-submit2 text-white mb-3 rounded border-white border-1" onclick="crearPost()">Subir</button>
										</form>
									</post-form>
									<!-- publicaciones -->
									<div class="accordion" id="accordionPublications">
										
									</div>
								</div>
								<div class="tab-pane fade" id="pills-verComo" role="tabpanel" aria-labelledby="pills-verComo-tab">
									<?php require '../views/verComo.php'; ?>
								</div>
							</div>
						</section>
					</div>
					<!-- Pestaña Acerca De -->
					<div class="tab-pane fade" id="acercaDe" role="tabpanel" aria-labelledby="acercaDe-tab">
						<section class="col-md-8 col-sm-4 position-center"><?php require '../views/acercaDe.php'; ?></section>
					</div>
					<!-- Pestaña perfil -->
					<div class="tab-pane fade" id="perfil" role="tabpanel" aria-labelledby="perfil-tab">
						<section class="col-md-8 col-sm-4 position-center"><?php require '../views/profile.php'; ?></section>
					</div>
					<!-- Pestaña Buzón -->
					<div class="tab-pane fade" id="buzon" role="tabpanel" aria-labelledby="buzon-tab">
						<section class="col-md-8 col-sm-4 position-center">
							<div class="d-flex align-items-start" >
								<div class="nav flex-column nav-pills col-2" id="v-pills-tab" role="tablist" aria-orientation="vertical"></div>
								<div class="tab-content col-10 p-2" id="v-pills-tabContent"></div>
							</div>
						</section>
					</div>
					<!-- Pestaña Usuarios -->
					<div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
						<section class="col-md-8 col-sm-4 position-center">
							<input type="text" name="busqueda" id="busqueda" placeholder="Buscar..." class="bg-dark text-white">
							<button type="button" onclick="actualizarUsers()" class="btn submit bg-dark text-white border-radius border-white" title="Actualizar usuarios"><i class="fa-solid fa-arrows-rotate"></i></button>
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
	<script src="../resources/js/appAdmin.js"></script>
	<script src="../resources/js/validar.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>	
</body>
</html>
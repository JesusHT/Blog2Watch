<?php require 'includes/sesion.php'; require 'includes/administrador.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://fonticons-free-fonticons.netdna-ssl.com/kits/1ce05b4b/publications/118813/woff2.css" media="all">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
	<link rel="stylesheet" type="text/css" href="resources\css\stylePlataformas.css">
  	<link rel="stylesheet" type="text/css" href="resources\css\styleReactions.css">
	<link rel="stylesheet" type="text/css" href="resources\css\styleNav.css">
  	<link rel="stylesheet" type="text/css" href="resources\css\style.css">
	<link rel="icon" type="image/png" href="Imagenes\icono.ico">
	<title>Blog2Watch</title>
</head>
<body>
	<div class="container">
		<div class="site-sidebar"> 
			<nav class="scroller gif"><div id="menu"><!-- Plataformas --></div></nav>
		</div>
		<header>
			<div class="col-md-8 position-center logo" align="center">
				<img src="Imagenes\logoblog.png">
			</div>
		</header>
		<nav class="nav justify-content-center navbar-dark mb-3 col-md-8 position-center row">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="bi bi-house-door-fill"></i> Inicio</button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" id="acercaDe-tab" data-bs-toggle="tab" data-bs-target="#acercaDe" type="button" role="tab" aria-controls="acercaDe" aria-selected="false"><i class="bi bi-info-circle-fill"></i> Acerca De</button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" id="perfil-tab" data-bs-toggle="tab" data-bs-target="#perfil" type="button" role="tab" aria-controls="perfil" aria-selected="false"><i class="bi bi-person-fill"></i> <?php if (!empty($user)){ echo $user['name']; } ?></button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" id="buzon-tab" data-bs-toggle="tab" data-bs-target="#buzon" type="button" role="tab" aria-controls="buzon" aria-selected="false"><i class="bi bi-mailbox"></i> Buzón</button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="users" role="tab" aria-controls="users" aria-selected="false"><i class="bi bi-people-fill"></i> Usuarios</button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" type="button" onclick="location.href='includes/logout.php'"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</button>
				</li>
			</ul>
		</nav>
		<div class="container">
			<content class="row">
				<div class="tab-content" id="myTabContent">		
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<section class="col-md-8 col-sm-4  position-center mb-3">
							<?php require 'includes\filtros.php'; ?>
						</section>
						<section class="col-md-8 col-sm-4 position-center">
							<post-form class="row post mb-3">
								<div class="mt-3">
									<?php 
										if (!empty($message)) {
											echo '<p class="message-correcto">' . $message . '</p>';	
										}
										if (!empty($message2)) {
											echo '<p class="message-error">' . $message2 . '</p>';
										}
									?>
								</div>
								<form action="index-administrador.php" method="POST" id="formul"> 
									<div class="form-floating mb-3">
										<input type="text" class="form-control bg-dark text-white" id="floatingInput" placeholder="title" name="title" maxlength="100" required>
										<label for="floatingInput">Titulo</label>
									</div>
									<div class="form-floating mb-3 ">
										<textarea type="text" class="form-control bg-dark text-white" style="height: 100px" id="floatingInput" placeholder="info" name="info"  minlength="6" maxlength="500" required></textarea>
										<label for="floatingInput">Información</label>
									</div>
									<div class="row g-2">
										<div class="form-floating mb-3 col-6">
											<select class="form-select bg-dark text-white"  id="floatingSelect" aria-label="Floating label select example" name="plataforma" required>
												<option selected disabled>Elija una plataforma</option>
												<option value="NETFLIX">Netflix</option>
												<option value="Amazon">Amazon Prime</option>
												<option value="Disney">Disney+</option>
												<option value="HBO">HBO</option>
												<option value="Otro">Otro</option>
											</select>
											<label for="floatingSelect">Plataforma</label>				
										</div>
										<div class="form-floating mb-3 col-6">
											<select class="form-select bg-dark text-white" id="floatingSelect" aria-label="Floating label select example" name="tipo" required>
												<option selected disabled>Elija el tipo</option>
												<option value="Pelicula">Pelicula</option>
												<option value="Serie">Serie</option>
											</select>
											<label for="floatingSelect">Tipo</label>				
										</div>
									</div>
									<input class="button-submit2 text-white mb-3" type="submit" value="Subir">
								</form>
							</post-form>
							<?php 
								if($query -> rowCount() > 0) { 
									foreach($results as $result) {
							?>
										<post class="row post mb-3 position-center">
											<div class="col-md-12 mt-2">
												<div class="row">
													<div class="col-md-10">
														<h3><?php echo $result -> titulo; ?></h3>
													</div>
													<div class="col-md-2 btn-group color"> 
														<form action="index-administrador.php" method="POST" >
															<input type="hidden" name="eliminar" value="<?php echo $result -> id_post; ?>">
															<button type="submit" class="submit"><i class="bi bi-trash-fill"></i></button>	
														</form>
														<form action="index-administrador.php" method="POST" >
															<input type="hidden" name="editar" value="<?php echo $result -> id_post; ?>">
															<button type="submit" class="submit"><i class="bi bi-pencil-square"></i></button>
														</form>
													</div>
												</div>
											</div>
											<post-info class="info-post mt-2 col-md-12"><p><?php echo $result -> info; ?></p></post-info>
											<div class="reaction" align="left">
												<?php require 'includes\reactioNs.php'; ?>
											</div>
											<post-comment class="col-md-12">
												<div class="col-md-12">
													<div class="body-comment mb-2">
														<p class="text-name-comment"><?php  ?></p><p class="text-comment"><?php  ?></p>
													</div>
												</div>
												<form action="" method="POST">
													<div class="input-group mb-3">
														<input type="hidden" name="id_post" value="<?php echo $result -> id_post; ?>">
														<textarea type="text" class="form-control textarea-comment" placeholder="Escribir comentari..." name="comment"></textarea>
														<button class="btn btn-outline-secondary submit-comment" type="submit" id="button-addon2"><i class="bi bi-chat-right-text-fill"></i></button>
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
					<div class="tab-pane fade" id="acercaDe" role="tabpanel" aria-labelledby="acercaDe-tab">
						<section class="col-md-8 col-sm-4 position-center"><?php require 'includes\acercaDe.php'; ?></section>
					</div>
					<div class="tab-pane fade" id="perfil" role="tabpanel" aria-labelledby="perfil-tab"><section class="col-md-8 col-sm-4 position-center">aaaa</section></div>
					<div class="tab-pane fade" id="buzon" role="tabpanel" aria-labelledby="buzon-tab">
						<section class="col-md-8 col-sm-4 position-center">
							<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
									<?php 
										if($query2 -> rowCount() > 0) { 
											foreach($comentarios as $buzon) {
									?>
										<button class="nav-link <?php if($comentarios[0] -> users == $buzon -> users){echo 'active';}?>" id="user<?php echo $buzon -> id_buzon;?>-tab" data-bs-toggle="pill" data-bs-target="#user<?php echo $buzon -> id_buzon;?>" type="button" role="tab" aria-controls="user-<?php echo $buzon -> id_buzon;?>" aria-selected="<?php if($comentarios[0] -> users == $buzon -> mensaje){echo 'true';}?>"><?php echo $buzon -> users; ?></button>
									<?php
											} 
										}
									?>
								</div>
								<div class="tab-content" id="v-pills-tabContent">
									<?php 
										if($query2 -> rowCount() > 0) { 
											foreach($comentarios as $buzon) {
									?>
										<div class="tab-pane fade <?php if($comentarios[0] -> mensaje == $buzon -> mensaje){echo 'show active';}?>" id="user<?php echo $buzon -> id_buzon;?>" role="tabpanel" aria-labelledby="user<?php echo $buzon -> id_buzon;?>-tab"><?php echo $buzon -> mensaje; ?></div>
									<?php
											} 
										}
									?>
								</div>
						</section>
							</section>
					</div>
					<div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
						<section class="col-md-8 col-sm-4 position-center">
							<input type="text" name="busqueda" id="busqueda" placeholder="Buscar..." class="bg-dark text-white">
							<table class="table table-dark mt-3">
								<thead>
									<tr>
										<td scope="col">#</td>
										<td scope="col">Usuario</td>
										<td scope="col">Eliminar</td>
									</tr>
								</thead>
								<tbody id="tabla_resultado"></tbody>
							</table>
						</section>
					</div>
				</div>
			</content>
		</div>
	</div>
	<script src="resources/js/plataformas.js"></script>
	<script src="resources/js/peticion.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/ulg/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

</body>
</html>
<?php require 'includes\sesion.php';?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://fonticons-free-fonticons.netdna-ssl.com/kits/1ce05b4b/publications/118813/woff2.css" media="all">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
	<link rel="stylesheet" type="text/css" href="resources\css\stylePlataformas.css">
  	<link rel="stylesheet" type="text/css" href="resources\css\styleReactions.css">
	<link rel="stylesheet" type="text/css" href="resources\css\styleNav.css">
  	<link rel="stylesheet" type="text/css" href="resources\css\style.css">
	<link rel="icon" type="image/png" href="resources\pictures\icono.ico">
	<title>Blog2Watch</title>
</head>
<body>
	<div class="container">
		<div class="site-sidebar"> 
			<nav class="scroller gif"><div id="menu"><!-- Plataformas --> </div></nav>
		</div>
		<header>
			<div class="col-md-8 position-center logo row justify-content-center"><img src="resources\pictures\logoblog.png"></div>
		</header>
		<nav class="nav justify-content-center navbar-dark mb-3 col-md-8 position-center row">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="bi bi-house-door-fill"></i> Home</button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" id="acercaDe-tab" data-bs-toggle="tab" data-bs-target="#acercaDe" type="button" role="tab" aria-controls="acercaDe" aria-selected="false"><i class="bi bi-info-circle-fill"></i> Acerca De</button>
				</li>
				<li class="nav-item col-4">
					<button class="nav-link" id="perfil-tab" data-bs-toggle="pill" data-bs-target="#perfil" type="button" role="tab" aria-controls="perfil" aria-selected="false" ><i class="bi bi-person-fill"></i> <?php if (!empty($user)){ echo $user['name']; } ?></button>
				</li>
			</ul>
		</nav>
		<content>
			<div class="container">
				<content class="row">
					<div class="tab-content" id="myTabContent">
						<!-- Pestaña de inicio -->
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<section class="col-md-8 col-sm-4 position-center mb-3"><?php require 'includes\filtros.php'; ?></section>
							<section class="col-md-8 col-sm-4 position-center">
								<?php 
									if($query -> rowCount() > 0) { 
										foreach($results as $result) {
								?>
											<post class="row border rounded-3 border-white mb-3 position-center">
												<!-- Titulo -->
												<div class="col-md-12 mt-2"><h3 class="text-white fw-bold"><?php echo $result -> titulo; ?></h3></div>
												<!-- Información -->
												<post-info class="info-post mt-2 col-md-12 text-white"><p><?php echo $result -> info; ?></p></post-info>
												<!-- Reacciones -->
												<div class="reaction text-white" align="left"><?php require 'includes\reactions.php'; ?></div>
												<!-- Comentarios -->
												<post-comment class="col-md-12">
													<div class="col-md-12">
														<div class="body-comment mb-2">
															<p class="text-name-comment"><?php  ?></p><p class="text-comment"><?php  ?></p>
														</div>
													</div>
													<form action="" id="formComment<?php echo $result -> id_post; ?>">
														<div class="input-group mb-3">
															<input type="hidden" name="id_user" id="id_user" value="<?php echo $user['id']; ?>">
															<input type="hidden" name="id_post" id="id_post" value="<?php echo $result -> id_post; ?>">
															<textarea type="text" name="comment" id="comment<?php echo $result -> id_post; ?>" class="form-control h-comment bg-dark text-white" placeholder="Escribir comentario..."></textarea>
															<button type="button" class="btn btn-outline-secondary submit-comment text-white" id="enviar" 
															onclick="enviarDatos(<?php echo $result -> id_post; ?>)">
																<i class="bi bi-chat-right-text-fill"></i>
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

						<!-- Pestaña Acerca De -->
						<div class="tab-pane fade" id="acercaDe" role="tabpanel" aria-labelledby="acercaDe-tab">
							<section class="col-md-8 col-sm-4 position-center"><?php require 'includes\acercaDe.php';?></section>	
						</div>

						<!-- Pestaña perfil -->
						<div class="tab-pane fade" id="perfil" role="tabpanel" aria-labelledby="perfil-tab">
							<section class="col-md-8 col-sm-4 position-center"><?php require 'includes\profile.php';?></section>
						</div>

					</div>
				</content>
			</div>
		</content>
		<!-- Buzón -->
		<buzon class="mailbox">
			<a class="mailbox2"><img src="resources/pictures/buzon.png" id="mailbox-open"></a>
			<a onclick="to_open()"><img src="resources/pictures/buzon1.png" id="mailbox-closed"></a>
		</buzon>
		<buzon-abierto class="v-mailbox text-dark rounded-2 bg-gray p-4 container-sm container-md" id="vent">
			<div class="row g-2 mb-2">
				<div class="col-10"><h5 class="fw-bold">BUZÓN</h5></div>
				<div class="col-2" align="right"><button type="button" class="text-light bg-visitante" onclick="location.href='javascript:close()'"><i class="bi bi-x-circle-fill"></i></button></div>
			</div>
			<div class="position-center bg-darkGray rounded p-2">
				<form action="" method="post">
					<div class="form-floating mb-3 mt-2">
						<select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="tipoMensaje" required>
							<option value="1">Sugerencia</option>
							<option value="2">Queja</option>
							<option value="3">Reportar error</option>
						</select>
						<label for="floatingSelect">Tipo</label>				
					</div>
					<div class="form-floating mb-3 ">
						<textarea type="text" class="form-control" style="height: 200px" id="floatingInput" placeholder="Mensaje..." name="mensajeBuzon"  minlength="6" maxlength="500" required></textarea>
						<label for="floatingInput"><i class="bi bi-chat-right-text"></i> Mensaje</label>
					</div>
					<button class="button-submit text-white mb-3" type="submit">Enviar <i class="bi bi-send-fill"></i></button>
				</form>
			</div>
		</buzon-abierto>
	</div>
	<!-- Scripts -->
	<script src="resources/js/app.js"></script>
	<script src="resources/js/script.js"></script>
	<script src="resources/js/validar.js"></script>
	<script src="resources/js/plataformas.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>	
</body>
</html>
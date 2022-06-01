<?php require '../includes/sesion.php';?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
	<link rel="stylesheet" type="text/css" href="../resources/css/stylePlataformas.css">
	<link rel="stylesheet" type="text/css" href="../resources/css/reactions.css">
	<link rel="stylesheet" type="text/css" href="../resources/css/styleNav.css">
  	<link rel="stylesheet" type="text/css" href="../resources/css/style.css">
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
			<div class="col-md-8 position-center logo row justify-content-center"><img src="../resources/img/logoblog.png" ></div>
		</header>
		<!-- Menú -->
		<nav class="nav justify-content-center navbar-dark mb-3 col-md-8 position-center row">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="fa-solid fa-house"></i> Home</button>
				</li>
				<li class="nav-item col-4" role="presentation">
					<button class="nav-link" id="acercaDe-tab" data-bs-toggle="tab" data-bs-target="#acercaDe" type="button" role="tab" aria-controls="acercaDe" aria-selected="false"><i class="fa-solid fa-circle-info"></i> Acerca De</button>
				</li>
				<li class="nav-item col-4">
					<button class="nav-link" id="perfil-tab" data-bs-toggle="pill" data-bs-target="#perfil" type="button" role="tab" aria-controls="perfil" aria-selected="false" ><i class="fa-solid fa-user"></i> <?php if (!empty($user)){ echo $user['name']; } ?></button>
				</li>
			</ul>
		</nav>
		<!-- Contenido -->
		<content>
			<div class="container">
				<content class="row">
					<div class="tab-content" id="myTabContent">
						<!-- Pestaña de inicio -->
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<!-- Filtros -->
							<section class="col-md-8 col-sm-4 position-center container mb-3"><?php require '../views/filtros.php'; ?></section>
							<!-- Publicaciones -->
							<section class="col-md-8 col-sm-4 position-center" id="post"></section>
						</div>
						<!-- Pestaña Acerca De -->
						<div class="tab-pane fade" id="acercaDe" role="tabpanel" aria-labelledby="acercaDe-tab">
							<section class="col-md-8 col-sm-4 position-center"><?php require '../views/acercaDe.php';?></section>	
						</div>

						<!-- Pestaña perfil -->
						<div class="tab-pane fade" id="perfil" role="tabpanel" aria-labelledby="perfil-tab">
							<section class="col-md-8 col-sm-4 position-center"><?php require '../views/profile.php';?></section>
						</div>

					</div>
				</content>
			</div>
		</content>
		<!-- Button trigger modal (BUZON) -->
		<div class="mailbox" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
			<a class="mailbox2"><img src="../resources/img/buzon.png" id="open"></a>
			<a id="mostrar"><img src="../resources/img/buzon1.png" id="closed"></a>
		</div>
		<!-- Modal BUZON -->
		<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content bg-gray text-white p-2">
		        <div class="modal-header">
		        	<h5 class="modal-title fw-bold" id="staticBackdropLabel">BUZON</h5>
		        	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_buzon"></button>
		      	</div>
		      	<div class="modal-body bg-darkGray text-dark">
				  <div id="Respuesta"></div>
				  <form id="enviarDatosBuzon">
						<div class="form-floating mb-3 mt-2"> 
							<input type="hidden" name="user_buzon" id="user_buzon" value="<?php echo $user['name'] ?>">
							<select class="form-select" id="tipo_mensaje" id="floatingSelect" aria-label="Floating label select example" name="tipoMensaje" required>
								<option value="1">Sugerencia</option>
								<option value="2">Queja</option>
								<option value="3">Reportar error</option>
							</select>
							<label for="floatingSelect"><i class="fa-solid fa-list-radio"></i> Tipo</label>				
						</div>
						<div class="form-floating mb-3 ">
							<textarea type="text" id="mensaje_buzon" class="form-control" style="height: 200px" id="floatingInput" placeholder="Mensaje..." name="mensajeBuzon"  minlength="6" maxlength="500" required></textarea>
							<label for="floatingInput"><i class="fa-solid fa-message"></i> Mensaje</label>
						</div>
						<button type="button" class="button-submit text-white" onclick="enviarDatosBuzon()">Enviar <i class="fa-solid fa-paper-plane"></i></button>
					</form>
		       	</div>
		    </div>
		  </div>
		</div>
	</div>
	<!-- Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="../resources/js/app.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>	
</body>
</html>
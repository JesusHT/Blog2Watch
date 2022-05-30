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
			<div class="col-md-8 position-center logo justify-content-center row"><img src="resources/img/logoblog.png"></div>
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
						<!-- filtros -->
						<section class="col-md-8 col-sm-4 position-center container mb-3"><?php require 'views/filtros.php'; ?></section>
						<!-- Publicaciones -->
						<section class="col-md-8 col-sm-4 position-center container" id="post"></section>
					</div>
					<!-- Pestaña acerca de -->
					<div class="tab-pane fade" id="acercaDe" role="tabpanel" aria-labelledby="acercaDe-tab">
						<section class="col-md-8 col-sm-4 position-center"><?php require 'views/acercaDe.php'; ?></section>
					</div>
				</div>
			</content>
		</div>
		<!-- Button trigger modal -->
		<div class="mailbox" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
		  	<img src="resources/img/buzon1.png" >
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="resources/js/appVisitante.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>
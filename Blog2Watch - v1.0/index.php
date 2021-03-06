<?php session_start(); if (isset($_SESSION['user_id'])){ $_SESSION['user_id'] == 43 ? header("Location: Administrador") : header("Location: Usuario"); }?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
	<link rel="stylesheet" type="text/css" href="resources\css\stylePlataformas.css">
	<link rel="stylesheet" type="text/css" href="resources\css\reactions.css">
	<link rel="stylesheet" type="text/css" href="resources\css\styleNav.css">
  	<link rel="stylesheet" type="text/css" href="resources\css\style.css">
	<link rel="icon" type="image/png" href="resources\img\icono.ico">
	<title>Blog2Watch</title>
</head>
<body>
	<div class="container">
		<!-- Menú de plataformas -->
		<div class="site-sidebar"> 
			<nav class="scroller gif">
				<div>
					<form method="POST" id="plataformas">
						<input type="radio" name="plataforma" id="netflix" value="1" onclick="filtros()">
						<label for="netflix"> <img src="resources/img/netflix.gif" alt="Gif NETFLIX"></label><br>

						<input type="radio" name="plataforma" id="amazon" value="2" onclick="filtros()">
						<label for="amazon"><img src="resources/img/primevideo.gif" alt="Gif AMAZON PRIME VIDEO"></label><br>

						<input type="radio" name="plataforma" id="disney" value="3" onclick="filtros()" >
						<label for="disney"><img src="resources/img/disneyplus.gif" alt="Gif DISNEY+"></label><br>

						<input type="radio" name="plataforma" id="hbo" value="4" onclick="filtros()" >
						<label for="hbo"><img src="resources/img/hbo.gif" alt="Gif HBO"></label><br>

						<input type="radio" name="plataforma" id="todo" value="5" onclick="filtros()" checked>
						<label for="todo" ><img src="resources/img/todo.gif" alt="Gif HBO"></label>
					</form>
				</div>
			</nav>
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
					<a href="./login.php"><button class="nav-link" type="button"><i class="fa-solid fa-user"></i> Inicio de sesion </button></a>
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
						<section class="col-md-8 col-sm-4 position-center container mb-3">
							<acordion-filtered class="acordion-item" id="accordionExample">
								<button class="btn text-white" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-controls="collapseOne"><i class="fa-solid fa-filter"></i> FILTROS</button>
								<div id="collapseOne" class="accordion-collapse collapse mt-2" data-bs-parent="#accordionExample">
									<form method="POST" id="filtros">
										<div class="row row g-2 text-white">
											<div class="col-6 mt-2 mb-3">
												<p>TIPO</p><hr>  <!-- sub indices o categorias -->
												<div class="form-check form-switch">
													<input class="form-check-input" type="radio" name="tipo" id="flexSwitchCheckSeries" value="1">
													<label class="form-check-label" for="flexSwitchCheckSeries">Series</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="radio" name="tipo" id="flexSwitchCheckPeliculas" value="2">
													<label class="form-check-label" for="flexSwitchCheckPeliculas">Peliculas</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="radio" name="tipo" id="flexSwitchCheckTodo" value="3" checked>
													<label class="form-check-label" for="flexSwitchCheckTodo">Todo</label>
												</div>
											</div>
											<div class="col-6 mt-2 mb-3">
												<p>FECHA DE CARGA</p><hr>
												<div class="form-check form-switch">
													<input class="form-check-input" type="radio" name="fecha" id="flexSwitchCheckMasReciente"  value="1" checked>
													<label class="form-check-label" for="flexSwitchCheckMasReciente">Más reciente</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="radio" name="fecha" id="flexSwitchCheckMenosReciente" value="2">
													<label class="form-check-label" for="flexSwitchCheckMenosReciente">Menos reciente</label>
												</div>
											</div>
										</div>
										<button type="button" onclick="filtros()" id="submit" class="btn text-white bg-darkRed bg-gradient"> Aplicar </button>
									</form>
									<button type="button" onclick="reset()" id="reset" class="btn text-white bg-darkRed bg-gradient mt-2" style="display:none;"> Borrar </button>
								</div>
							</acordion-filtered>
						</section>
						<!-- Publicaciones -->
						<section class="col-md-8 col-sm-4 position-center container" id="post">
							
						</section>
					</div>
					<!-- Pestaña acerca de -->
					<div class="tab-pane fade" id="acercaDe" role="tabpanel" aria-labelledby="acercaDe-tab">
						<section class="col-md-8 col-sm-4 position-center">
							<div class="row">
								<div class="row">
									<div class="col-md-12 mt-2 mb-2"><h3 class="txt-justify text-white text-decoration-underline">Sobre el Sitio</h3></div>
									<p class="txt-justify text-white fw-bold">
										Blog2Watch es un blog creado en el año de 2022 con la finalidad de recomendar a los usuarios cinéfilos 
										diferentes opiniones de películas y series. En este sitio pueden encontrarse publicaciones sobre 
										películas y series que las plataformas de streaming más populares (Netflix, Disney, Amazon Prime 
										Video y HBO Max) ofrecen a los consumidores estos servicios.
									</p>
								</div>

								<div class="row">
									<div class="col-md-12 mt-2 mb-2"><h3 class="txt-justify text-white fw-bold text-decoration-underline">Equipo de Desarrollo</h3></div>
									<div class="col">
										<img src="resources/img/perfil.png" class="card-img-top perfil-img d-block mx-auto" loading="lazy">
										<p class="text-center text-white fw-bolder mt-4">Diseñadora<br>Fátima Marín</p>
										<p class="text-center text-white">fmarin0@ucol.mx</p><br>
									</div>
									<div class="col">
										<img src="resources/img/perfil.png" class="card-img-top perfil-img d-block mx-auto" loading="lazy">
										<p class="text-center text-white fw-bolder mt-4">Líder de Proyecto<br>Ximena Manzo</p>
										<p class="text-center text-white">xmanzo@ucol.mx</p><br>
									</div>
								</div>

								<div class="row">
									<div class="col">
										<img src="resources/img/perfil.png" class="card-img-top perfil-img d-block mx-auto" loading="lazy">
										<p class=" text-center text-white fw-bolder mt-4">Codificador<br>Jesús Hernández</p>
										<p class="text-center text-white">jhernandez117@ucol.mx</p><br>
									</div>
									<div class="col">
										<img src="resources/img/perfil.png" class="card-img-top perfil-img d-block mx-auto" loading="lazy">
										<p class=" text-center text-white fw-bolder mt-4">Analista<br>Geremi Gomez</p>
										<p class="text-center text-white">ggomez19@ucol.mx</p><br>
									</div>
								</div>
							</div>
						</section>
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
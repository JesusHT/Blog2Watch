<?php 
  session_start();

  require 'includes\db.php';
  
	$titulo = "";
	$info = "";
	$plataforma = "";
	$tipo = "";
	$message = "";
	$message2 = "";

	if (isset($_SESSION['user_id'])) {
		$records = $conn->prepare('SELECT * FROM users WHERE id = :id');
		$records -> bindParam(':id', $_SESSION['user_id']);
		$records -> execute();
		$results = $records -> fetch(PDO::FETCH_ASSOC);

		$user = null;

		if (count($results) > 0) {
			$user = $results;
		}

	}

	if (isset($_POST['title'])) {
		$titulo = $_POST['title'];
		$info = $_POST['info'];
		$plataforma = $_POST['plataforma'];
		$tipo = $_POST['tipo'];

		if (!empty($titulo) && !empty($info) && !empty($plataforma) && !empty($tipo)){
			$records = $conn -> prepare('SELECT * FROM post WHERE titulo = :titulo');
			$records->bindParam(':titulo', $titulo);
			$records->execute();
			$results = $records -> fetch(PDO::FETCH_ASSOC);
	
			if (is_countable($results) > 0) {
				$message2 = 'Ya existe una publicación con ese titulo';
			} else {
				$sql = "INSERT INTO post (titulo, info, plataforma, tipo) VALUES (:titulo, :info, :plataforma, :tipo)";
				$stmt = $conn -> prepare($sql);
		
				$stmt -> bindParam(':titulo', $titulo);
				$stmt -> bindParam(':info', $info);
				$stmt -> bindParam(':plataforma', $plataforma);
				$stmt -> bindParam(':tipo', $tipo);
		
				if ($stmt -> execute()) {
					$message = '¡Publicación subida exitoxamente!';
				} else {
					$message2 = '¡No se ha podido subir la publicación!';
				}	
			}
		}
		
	}

	if(isset($_POST['eliminar'])){
		$sql = "DELETE FROM post WHERE id_post = :id_post";
		$stmt = $conn -> prepare($sql);
		$stmt -> bindParam(':id_post', $_POST['eliminar']);
		$stmt -> execute();
	} 
?>

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
		<nav class="col-md-8 position-center mb-4 text-nav">
			<center>
				<div class="buttons-nav-text">
					<a href=""><button class="bts button-nav-active"><img src="Imagenes\home.png" width="30" height="30"><p>Inicio</p></button></a>				
					<a href=""><button class="bts button-nav buttons-nav"><img src="Imagenes\acercade.png" width="30" height="30"><p>Acerca De</p></button></a>
					<button class="bts button-nav buttons-nav dropdown"><img src="Imagenes\login.png" width="25" height="30"><br> <?php  if (!empty($user)){ echo `<p>`, strtoupper($user['name']) ,`</p>`; } ?>
						<div class="dropdown-content">
					    <a href="#">Cambiar Contraseña</a>					
					    <a href="logout.php">Cerrar Sesión</a>
					  </div>
					</button>
				</div>
			</center>
		</nav>
		<content>
			<div class="container-fluid">
				<content class="row">
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
	<script src="resources\script.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>

								

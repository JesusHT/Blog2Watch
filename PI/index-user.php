<?php 
  session_start();

  require 'includes\db.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT * FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  } 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="resources\style.css">
	<link rel="icon" type="image/png" href="Imagenes\icono.ico">
	<title>Blog2Watch</title>
</head>
<body class="body">
	<div class="container-xx1">
		<header>
			<div class="col-md-8 position-center logo">
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
			<div class="container">
				<content class="row">
					<section class="col-md-8 position-center mb-3">
						<?php require 'includes\filtros.php'; ?>
					</section>
					<section class="col-md-8 position-center">
					<?php 
							if($query -> rowCount() > 0) { 
								foreach($results as $result) {
						?>
									<post class="row post">
										<div class="col-md-12 mt-2">
											<post-title class="title-post"><h3><?php echo $result -> titulo; ?></h3></post-title>
										</div>
										<post-info class="info-post mt-2"><p><?php echo $result -> info; ?></p></post-info>
										<post-reactions>
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
<?php 

	require 'db.php';

	use PHPMailer\PHPMailer\PHPMailer;

	require 'phpmailer/PHPMailer/src/PHPMailer.php';
	require 'phpmailer/PHPMailer/src/SMTP.php';

	# Declaramos las variables que vamos a utilizar, esto con el fin de que no aparezca el warning de variable indefinida.
	$user = "";
	$pass = "";
	$question = "";
	$respuesta = "";
	$message = "";
	$correo = "";
	$id_user = "";
	$newPass = "";
	$tipo_mensaje = "";
	$mensaje_buzon = "";

	function validarUsuario($name, $conn){
		$records = $conn -> prepare('SELECT * FROM users WHERE name = :name');
		$records -> bindParam(':name', $name);
		$records -> execute(); 

		return $records -> fetch(PDO::FETCH_ASSOC);
	}

	# Registro de usuarios 	
	if (isset($_POST['name']) && isset($_POST['pregunta']) && isset($_POST['respuesta'])) {
		$user = $_POST['name'];
		$pass = $_POST['pass'];
		$question = $_POST['pregunta'];
		$respuesta = $_POST['respuesta'];

		if (!empty($user) && !empty($pass) && !empty($question) && !empty($respuesta)) {

			$validar = validarUsuario($user, $conn);

		    if (is_countable($validar) > 0) {
		    	$message = '<p class="bg-red fw-bold text-white p-1">El usuario ya existe</p>';
		    } else {
			    $sql = "INSERT INTO users (name, pass, pregunta, respuesta) VALUES (:name, :pass, :pregunta, :respuesta)";
			    $stmt = $conn->prepare($sql);

			    $stmt -> bindParam(':name', $user);
			    $password = password_hash($pass, PASSWORD_BCRYPT);

			    $stmt -> bindParam(':pass', $password);
			    $stmt -> bindParam(':pregunta', $question);
			    $stmt -> bindParam(':respuesta', $respuesta);

				$message = $stmt -> execute() ? '<p class="bg-green fw-bold text-white p-1">¡Usuario registrado exitosamente!</p>' : '<p class="bg-red fw-bold text-white p-1">¡No se ha podido registrar el usuario!</p>';
			} 
		}
		
	# Inicio de sesión  
	} else if (isset($_POST['name']) && isset($_POST['pass']) && empty($_POST['user2'])) {
		session_start(); 

		$user = $_POST['name'];
		$pass = $_POST['pass'];

		if (!empty($user) && !empty($pass)) {
			$validar = validarUsuario($user, $conn);

		    if (is_countable($validar) > 0 && password_verify($pass, $validar['pass'])) {
		      	if ($validar['name'] == 'Administrador'){ 
		      		$_SESSION['user_id'] = $validar['id'];
		     		header("Location: index-administrador.php"); 
		      	} else { 
		      		$_SESSION['user_id'] = $validar['id']; 
		     		header("Location: index-user.php");
		      	}
		    } else {
				$message = '<p class="bg-red fw-bold text-white p-1">El usuario y/o la contraseña son incorrectos</p>'; 
		    }
		}

	# Recuperación de contraseña
	} else if (isset($_POST['correo']) && isset($_POST['respuesta']) && isset($_POST['pregunta']) && isset($_POST['user2'])){
		$user = $_POST['user2'];
		$question = $_POST['pregunta'];
		$respuesta = $_POST['respuesta'];
		$correo = $_POST['correo'];

		if (!empty($correo) && !empty($user) && !empty($respuesta)) {
			$validar = validarUsuario($user, $conn);

		    if (is_countable($validar) > 0) {
			    if ($validar['respuesta'] == $respuesta) {
			      	$sql = "UPDATE users SET pass = :pass WHERE id = :id";
			      	$stmt = $conn -> prepare($sql);

			      	$stmt -> bindParam(':id', $validar['id']);

			      	$newpass = "";
					$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
					$max = strlen($pattern)-1;
					for($i = 0; $i < 10; $i++){ 
						$newpass .= substr($pattern, mt_rand(0,$max), 1);
					}

					$mail = new PHPMailer(true);

					//Server settings
					$mail->SMTPDebug = 2;                                 // Enable verbose debug output
					$mail->isSMTP();                                      // Set mailer to use SMTP
					$mail->Host = 'smtp.gmail.com';                   	  // Specify main and backup SMTP servers
					$mail->SMTPAuth = true;                               // Enable SMTP authentication
					$mail->Username = 'blogtwowatch@gmail.com';           // SMTP username
					$mail->Password = '!Root123';                         // SMTP password
					$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
					$mail->Port = 587;                                    // TCP port to connect to
		
					//Recipients
					$mail->setFrom('blogtwowatch@gmail.com', 'Blog2Watch');
					$mail->addAddress($correo, $user);
		
					//Content
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = 'Recuperar password';
					$mail->Body    = '<!DOCTYPE html>
					<html lang="es">
					<head>
						<meta charset="UTF-8">
						<meta http-equiv="X-UA-Compatible" content="IE=edge">
						<meta name="viewport" content="width=device-width, initial-scale=1.0">
						<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
						<style> 
					
						.column {
							width: 100%;
							}@media (min-width: 600px) {
						.column {
							width: 90%;
						}}
						.container {
							width: 100%;
							margin: 1em auto;
							padding: 1em 5%;
							background: rgb(0, 0, 0,0);
						}
					
						main {
							display: flex;
							flex-wrap: wrap;
							justify-content: space-between;
						}
						div {
							flex-basis: 100%;
							width: 100%;
							height: auto;
							margin: 0rem;
						}
					
						@media (min-width: 600px) {
							main {
							flex-wrap: nowrap;
							}
							div {
							flex-basis: 40%;
							}
						}
					
						* {
							box-sizing: border-box;
						}
						html {
							font-size: 100%;
							font-family: sans-serif;
							/*line-height: 1.5;*/
							color: #fff;
						}
						h1, h2 {
							margin-bottom: .5em;
						}
					
						h1 {
							font-size: 2rem;
							text-align: center;
						}
					  
						h2 {
							font-size: 1.6rem;
						}
					
						p {
							margin-bottom: 1em;
						}
					
						.cuadro{
							width: 100%; 
							height: auto;
							display: flex;
							flex-wrap: wrap;
							position: relative;
							margin-top: 0rem;
						}
						.fondo{
							width: 100%;
							position: absolute;
							display: flex;
							flex-wrap: wrap;
							height: auto; 
							opacity: 1;
							background: rgb(0, 0, 0,0);
							margin: 0rem 0rem 0rem 0rem;
						}
						.logo{
							width: 100%;
							height: auto;
							position: absolute;
							display: flex;
							flex-wrap: wrap;
							opacity: 1;
							z-index: 20;
							margin: 0rem 0rem 0rem 25rem;
						}
					
						.titulo{
							width: 100%;
							height: auto;
							position: absolute;
							display: flex;
							flex-wrap: wrap;
							opacity: 1;
							z-index: 20;
							/*background: rgb(123, 154, 128, 0.3);*/
							margin: -2rem 0rem 0rem 5rem;
						}.texto{
							color: rgba(47, 47, 47, 0.655);
							font-size: 9.8rem;
							font-family: Arial, sans-serif;      
							font-weight: bold;  
							text-align: center;
							padding: -10rem 0rem 0rem 0rem;
						}
					
						.cuerpo{
							color: #fff;
							font-family: Calibri, sans-serif;
							text-align: justify;
							/*padding: 130px 85px 0px 85px;*/
							margin: 1rem 2rem 2rem 1rem;
						}
					
						.links{
							color: white; 
							background-color: rgb(5, 0, 95); 
							width: 5rem;
							height: auto;
							/*padding-top: 0.2rem;*/
							text-align: center;
							font-family: Calibri, sans-serif;
							font-size: 1.5rem;
							text-decoration: none;
							margin: 2rem 2rem 2rem 2rem;
							padding: 1rem 1rem 0.5rem 1rem; 
						}
						@media (min-width: 600px) {
							.links{
							color: white; 
							background-color: rgb(5, 0, 95); 
							width: 70%;
							height: auto;
							padding-top: 0.2rem;
							/*text-align: center;*/
							font-family: Calibri, sans-serif;
							font-size: 1.5rem;
							margin: 0.4rem 0rem 0rem 0rem;
							text-decoration: none;
						}
						}
						
						</style>
					</head>
					
					<body style="background-color: #000000;">
						<div class="cuadro";>
							<!--<div class="fondo">-->
								<center><h1><div class="titulo texto">BLOG2WATCH</div></h1></center>
								<center><div class="logo"><img src="https://i.ibb.co/dMWmZGV/logo.png" alt="Blog2Watch" title="Blog2Watch"></div></center>
								<p class="cuerpo" style="font-size: 2rem; padding: 8rem 6rem 0rem 6rem;"><br><br>Hola, ' . $user . ':</p>
								<p class="cuerpo" style="font-size: 1.5rem; padding: 0rem 6rem 0rem 6rem;">Queremos que sigas disfrutando de nuestro contenido, así que hemos generado una contraseña temporal que podrás cambiar en cualquier momento en el apartado de "Perfil" de nuestro Blog.</p>
								<p class="cuerpo" style="font-size: 1.5rem; padding: 0rem 6rem 0rem 6rem;">Nueva contraseña:' . $newpass . '</p>
								<p class="cuerpo" style="font-size: 1.5rem; padding: 0rem 6rem 0rem 6rem;">Regresa al login...</p>
								<center><div class="links">' . $newpass . '</div></center><br><br>
								<center><div class="links" style="text-decoration: underline;"><a href="../login.php" style="color: #fff;">Seguir al login</a></div></center>
								<p class="cuerpo" style="font-size: 1rem; padding: 8rem 8rem 0rem 8rem; text-align: center; font-style: italic;">Aviso de Privacidad: Blog2Watch no almacena en su base de datos ninguna información personal tal como correo electrónico, nombres o fechas de nacimiento.</p>
							<!--</div>-->
						</div><br>
					</body>
					</html>';
		
					$mail->send();

			      	$password = password_hash($newpass, PASSWORD_BCRYPT);
			      	$stmt -> bindParam(':pass', $password);

			      	if ($stmt -> execute()) {
						$_COOKIE['user'] = null;
					  	$message = '<p class="bg-green fw-bold text-white p-1">¡Se ha enviado a tu correo tu nueva contraseña!</p>';
					} else {
					 	$message = '<p class="bg-red fw-bold text-white p-1">¡No se ha podido restablecer la contraseña!</p>';
					}
			    } else {
			      	$message = '<p class="bg-red fw-bold text-white p-1">Datos incorrectos</p>';
			    }
		    } else {
		      	$message = '<p class="bg-red fw-bold text-white p-1">El usuario no existe. <a href="sign_up.php">Regístrate</a></p>';
		    }
		}
	}
	
	# Recuperación de contraseña (Validar si el usuario existe)
	if (isset($_POST['user'])){
		$user = $_POST['user'];
		
		if (!empty($user)) {
			$validar = validarUsuario($user, $conn);

			if (is_countable($validar) > 0) {
				setcookie("user", $user);
				header("Location: validacion.php");
			} else {
				$message = '<p class="bg-red fw-bold text-white p-1">El usuario no existe. <a href="sign_up.php">Regístrate</a></p>';
			}
		}
	}

	# Validamos que la COOKIE se haya creado correctamente para poder mostrar la pregunta de seguridad sin necesidad de que el usuario la ponga, esto por el posible escenario donde se le olvidé la pregunta.
	if (isset($_COOKIE['user'])) {  
		$validar = validarUsuario($_COOKIE['user'], $conn);

		$preguntas = ['¿Cómo rayos lograste ver esta pregunta?','¿Cuál es el nombre de mi mascota?','¿Cuál es mi canción favorita?','¿Cuál es mi videojuego favorito?'];

		$users = null;
		$users = (is_countable($validar) > 0) ? $validar : null;
	}

	# Cambiar contraseña
	if (isset($_POST['newPass']) && isset($_POST['id_user']) && isset($_POST['actualPass'])) {
		$id_user = $_POST['id_user'];
		$pass = $_POST['actualPass'];
		$newPass = $_POST['newPass'];
		$data = "";

		if (!empty($id_user) && !empty($pass) && !empty($newPass)) {
			$records = $conn -> prepare('SELECT * FROM users WHERE id = :id');

			$records -> bindParam(':id', $id_user);
			$records -> execute();
			$results = $records->fetch(PDO::FETCH_ASSOC);

			if (password_verify($pass, $results['pass'])) {
				$sql = "UPDATE users SET pass = :pass WHERE id = :id";
			    
				$stmt = $conn -> prepare($sql);
				$stmt -> bindParam(':id', $id_user);
				$password = password_hash($newPass, PASSWORD_BCRYPT);
			    $stmt -> bindParam(':pass', $password);

				$data = $stmt -> execute() ? '¡Se ha cambiado tú contraseña exitosamente!' : '¡No se ha podido cambiar la contraseña!';

			} else {
				$data = "¡La información es incorrecta!";
			}
			die(json_encode($data));
		}
	}

	# Cambiar pregunta y respuesta 
	if (isset($_POST['pass']) && isset($_POST['id_user']) && isset($_POST['newPregunta']) && isset($_POST['newRespuesta'])) {
		$id_user = $_POST['id_user'];
		$pass = $_POST['pass'];
		$question = $_POST['newPregunta'];
		$respuesta = $_POST['newRespuesta'];
		$data = "";

		if (!empty($id_user) && !empty($pass) && !empty($question) && !empty($respuesta)) {
			$records = $conn -> prepare('SELECT * FROM users WHERE id = :id');

			$records -> bindParam(':id', $id_user);
			$records -> execute();
			$results = $records->fetch(PDO::FETCH_ASSOC);

			if (password_verify($pass, $results['pass'])) {
				$sql = "UPDATE users SET pregunta = :pregunta, respuesta = :respuesta WHERE id = :id";
			    
				$stmt = $conn -> prepare($sql);
				$stmt -> bindParam(':id', $id_user);
			    $stmt -> bindParam(':pregunta', $question);
			    $stmt -> bindParam(':respuesta', $respuesta);

				$data = $stmt -> execute() ? '¡Se ha cambiado tú pregunta y respuesta de seguridad exitosamente!' : '¡No se ha podido cambiar la pregunta y respuesta de seguridad!';

			} else {
				$data = "¡La información es incorrecta!";
			}
			die(json_encode($data));
		}
	}

	# Buzón
	if (isset($_POST['tipoMensaje']) && isset($_POST['mensajeBuzon']) && isset($_POST['user_buzon'])) {
		$tipo_mensaje = $_POST['tipoMensaje'];
		$mensaje_buzon = $_POST['mensajeBuzon'];
		$user = $_POST['user_buzon'];

		if (!empty($tipo_mensaje) && !empty($mensaje_buzon) && !empty($user)) {
			$sql = "INSERT INTO buzon (users, tipo_mensaje, mensaje) VALUES (:users, :tipo_mensaje, :mensaje)";
			$stmt = $conn -> prepare($sql);
			$stmt -> bindParam(':users', $user);
			$stmt -> bindParam(':tipo_mensaje', $tipo_mensaje);
			$stmt -> bindParam(':mensaje', $mensaje_buzon);

			$data = $stmt -> execute() ? '<p class="bg-green fw-bold text-white p-1">Mensaje Enviado Correctamente!</p>' : '<p class="bg-red fw-bold text-white p-1">No se ha podido enviar el mensaje</p>';

			echo json_encode($data);
		}
	}
	
?>
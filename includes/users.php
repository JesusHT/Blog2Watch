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
	} else if (isset($_POST['correo']) && isset($_POST['respuesta']) && isset($_POST['user2'])){
		$respuesta = $_POST['respuesta'];
		$correo = $_POST['correo'];
		$user = $_POST['user2'];

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
						<style>
							img {
								display: block;
								margin: 0 auto;
								height: auto;
								width: 250px;
							}
							section, footer {
								padding: 0px 15%;
								margin-bottom: 30px;
							}
							p {text-align: justify;
							color:#fff;}
							button {
								display: block;
								margin: 0 auto;
								padding: 0.375rem 0.75rem;
								cursor: pointer;
								background-color: rgb(5,0,95);
								transition: background-color 2s;
							} button:hover{
							  background-color: rgb(62, 63, 132); 
							}
							a {
								color: #fff;
								font-size: 1.3em;
							}
							p span {
								background-color: rgb(5,0,95);
								padding: 0.375rem 0.75rem;
							}
							.text-center{
								text-align: center;
							}
						</style>
					</head>
					<body style="margin: 0px; padding: 0px; background-color: #202124; color: #fff; font-family:Verdana, Geneva, Tahoma, sans-serif;">
						<header>
							<img src="https://i.ibb.co/dMWmZGV/logo.png" alt="Logo Blog2Watch" >
						</header>
						<section>
							<article>
								<p>Hola, '. $user .'</p>
								<p>Queremos que sigas disfrutando de nuestro contenido, así que hemos generado una contraseña temporal que podrás cambiar en cualquier momento en el apartado de "Perfil" de nuestro Blog.  </p>
								<p>Nueva contraseña: '. $newpass .'</p>
								<p class="text-center"><span>'. $newpass .'</span></p>
							</article>
							<article>
								<button><a href="">Seguir al login</a></button>
							</article>
						</section>
						<footer>
							<p><b>Aviso De Privacidad:</b> En Blog2Watch respetamos tu privacidad, por ello jámas almacenaremos en nuestra base de datos el correo proporcionado para la recuperación de contraseña, de igual manera jámas te pediremos ningun dato personal.</p>
							<p><b>Aviso Importante:</b> Este correo electrónico y/o el material adjunto es para uso exclusivo de la persona a la que expresamente se le ha enviado, el cual contiene información confidencial. Si usted ha recibido esta transmisión por error, notifíquenos inmediatamente en nuestros correo electrónico oficial y borre dicho mensaje y sus anexos en caso de contenerlos. Se hace de su conocimiento por medio de esta nota, que cualquier divulgación, copia, distribución o toma de cualquier acción derivada de la información confiada en esta transmisión, queda estrictamente prohibido. </p>
						</footer><br><br>
					</body>
					</html>';
		
					$mail->send();

			      	$password = password_hash($newpass, PASSWORD_BCRYPT);
			      	$stmt -> bindParam(':pass', $password);

					$data = $stmt -> execute() ? true : false;
					die(json_encode($data));
			    } else {
			      	$data = false;
					die(json_encode($data));
			    }
		    } else {
		      	$data = false;
				die(json_encode($data));
		    }
		}
	}
	
	# Recuperación de contraseña (Validar si el usuario existe)
	if (isset($_POST['user'])){
		$user = $_POST['user'];
		
		if (!empty($user)) {
			$validar = validarUsuario($user, $conn);

			if (!empty($validar)) {
				$preguntas = ['¿Cómo rayos lograste ver esta pregunta?','¿Cuál es el nombre de mi mascota?','¿Cuál es mi canción favorita?','¿Cuál es mi videojuego favorito?'];
				$data = '<form method="POST" id="formValidar">
						<input type="hidden" name="user2" value="'.$validar['name'].'">
							<div class="form-floating mb-3">
								<input class="align-input form-control" type="email" name="correo" required id="floatingEmail" placeholder="...">
								<label for="floatingEmail"><i class="fa-solid fa-envelope"></i> Correo</label>
							</div>
							<div class="form-floating mb-3">
								<input class="align-input form-control" type="text" value="'. $preguntas[$validar['pregunta']] .'" id="floatingPregunta" placeholder="..." readonly="readonly">
								<label for="floatingPregunta"><i class="fa-solid fa-block-question"></i> Pregunta de seguridad</label>				
							</div>
							<div class="form-floating mb-3">
								<input class="align-input form-control" type="text" name="respuesta" minlength="3" maxlength="20" required id="floatingResponse" placeholder="...">
								<label for="floatingResponse"><i class="fa-thin fa-comment-minus"></i> Respuesta</label>
							</div>
							<input class="button-submit align-input mb-3 text-white" type="button" value="Continuar" onclick="validar()"> 
						</form>';

				die(json_encode($data));
			} else {
				$data = false;
				die(json_encode($data));
			}
		}
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


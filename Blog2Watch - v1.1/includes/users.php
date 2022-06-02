<?php 

	require 'db.php';
	
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

		    if (!empty($validar)) {
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

		    if (!empty($validar) && password_verify($pass, $validar['pass'])) {
		      	if ($validar['name'] == 'Administrador'){ 
		      		$_SESSION['user_id'] = $validar['id'];
		     		header("Location: Administrador"); 
		      	} else { 
		      		$_SESSION['user_id'] = $validar['id']; 
		     		header("Location: Usuario");
		      	}
		    } else {
				$message = '<p class="bg-red fw-bold text-white p-1">El usuario y/o la contraseña son incorrectos</p>'; 
		    }
		}

	# Recuperación de contraseña
	} else if (isset($_POST['respuesta']) && isset($_POST['user2'])){
		$respuesta = $_POST['respuesta'];
		$user = $_POST['user2'];

		if (!empty($user) && !empty($respuesta)) {
			$validar = validarUsuario($user, $conn);

		    if (!empty($validar)) {
			    if ($validar['respuesta'] == $respuesta) {
					$data = []; 
			      	$sql = "UPDATE users SET pass = :pass WHERE id = :id";
			      	$stmt = $conn -> prepare($sql);

			      	$stmt -> bindParam(':id', $validar['id']);

			      	$newpass = "";
					$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
					$max = strlen($pattern)-1;
					for($i = 0; $i < 10; $i++){ 
						$newpass .= substr($pattern, mt_rand(0,$max), 1);
					}

			      	$password = password_hash($newpass, PASSWORD_BCRYPT);
			      	$stmt -> bindParam(':pass', $password);

					$data[0] = $validar['name'];
                    $data[1] = $newpass;
					$data[2] = $stmt -> execute() ? true : false;
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


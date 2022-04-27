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
	$message2 = "";
	$correo = "";
	
	
	// Inicio de sesion de usuario 	
	if (isset($_POST['name']) && isset($_POST['pass'])) { # Validamos que exista un valor en $_POST['name'] y  $_POST['pass'].
		session_start(); # Iniciamos una sesion que nos ayudara más tarde.

		# Asignamos las variables previamente declaradas a sus respectivos $_POST.
		$user = $_POST['name'];
		$pass = $_POST['pass'];

		if (!empty($user) && !empty($pass)) { # Validamos que no este vacia la variable $user y $pass.
		    $records = $conn -> prepare('SELECT * FROM users WHERE name = :name'); # Preparamos una sentencia sql.
		    $records -> bindParam(':name', $user); # asiganamos el valor que tendra :name (bindParam = Vincula un parámetro al nombre de variable especificado)
		    $records -> execute(); # Ejecutamos la sentencia sql.
		    $results = $records -> fetch(PDO::FETCH_ASSOC); # Obtenemos los datos de la bd (PDO::FETCH_ASSOC: devuelve un array indexado por los nombres de las columnas del conjunto de resultados.) y le asignamos la variable $result a los datos obtenidos.


		    if (is_countable($results) > 0 && password_verify($pass, $results['pass'])) { # validamos que el usuario exista y que la contraseña sea correcta.
		      	if ($results['name'] == 'Administrador' || $results['name'] == 'xime.mzo'){ # Validadmos que sea la cuenta de administrador.
		      		$_SESSION['user_id'] = $results['id']; # Le asiganomos a una variable $_SESSION la id del usuario.
		     		header("Location: ../PI/index-administrador.php"); # Redirigimos al usuario al index administrador.
		      	} else { 
		      		$_SESSION['user_id'] = $results['id']; # Le asiganomos a una variable $_SESSION la id del usuario.
		     		header("Location: ../index-user.php"); # Redirigimos al usuario al index user.
		      	}
		    } else {
				$message = "El usuario y/o la contraseña son incorrectos"; 
		    }
		}
		// Registro de usuario 
	} else if (isset($_POST['name']) && isset($_POST['pregunta'])) {
		$user = $_POST['name'];
		$pass = $_POST['pass'];
		$question = $_POST['pregunta'];
		$respuesta = $_POST['respuesta'];


		if (!empty($user) && !empty($pass) && !empty($question) && !empty($respuesta)) {

		  	$records = $conn -> prepare('SELECT * FROM users WHERE name = :name');
		    $records -> bindParam(':name', $user);
		    $records -> execute();
		    $results = $records -> fetch(PDO::FETCH_ASSOC);

		    if (is_countable($results) > 0) {
		    	$message2 = 'El usuario ya existe';
		    } else {
			    $sql = "INSERT INTO users (name, pass, pregunta, respuesta) VALUES (:name, :pass, :pregunta, :respuesta)";
			    $stmt = $conn->prepare($sql);

			    $stmt -> bindParam(':name', $user);
			    $password = password_hash($pass, PASSWORD_BCRYPT);

			    $stmt -> bindParam(':pass', $password);
			    $stmt -> bindParam(':pregunta', $question);
			    $stmt -> bindParam(':respuesta', $respuesta);

			    if ($stmt -> execute()) {
			      $message = '¡Usuario registrado exitoxamentes!';
			    } else {
			      $message2 = '¡No se ha podido registrar el usuario!';
			    }
			} 
		}
	// Recuperación de contraseña
	} else if (isset($_POST['correo']) && isset($_POST['respuesta']) && isset($_POST['pregunta']) && isset($_POST['user2'])){
		$user = $_POST['user2'];
		$question = $_POST['pregunta'];
		$respuesta = $_POST['respuesta'];
		$correo = $_POST['correo'];


		if (!empty($correo) && !empty($user) && !empty($respuesta)) {
		  	$records = $conn -> prepare('SELECT * FROM users WHERE name = :name');

		  	$records -> bindParam(':name', $user);
		    $records -> execute();
		    $results = $records->fetch(PDO::FETCH_ASSOC);

		    if (is_countable($results) > 0) {
			    if ($results['respuesta'] == $respuesta) {
			      	$sql = "UPDATE users SET pass = :pass WHERE id = :id";
			      	$stmt = $conn -> prepare($sql);

			      	$stmt -> bindParam(':id', $results['id']);

			      	$newpass = "";
					$pattern = "1234567890abcdefghijklmnopqrstuvwxyz"; // Definimos que caracters debe tener la contraseña
					$max = strlen($pattern)-1; // Determina el tamaño de un array
					for($i = 0; $i < 10; $i++){ 
						$newpass .= substr($pattern, mt_rand(0,$max), 1); // Extraemos valores de pattern de manera aleatoria 
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
						<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
					</head>
					<body style="background-color: #000000; color: #fff;">
						<div align="center"><img src="https://i.ibb.co/dMWmZGV/logo.png" alt="Blog2Watch" title="Blog2Watch" width="250"></div>
						<div style="height: 400px; padding: 10px 50px 20px;">
							<p>Nueva contraseña: ' . $newpass . '</p>
						</div>
					</body>
					</html>';
		
					$mail->send();

			      	$password = password_hash($newpass, PASSWORD_BCRYPT);
			      	$stmt -> bindParam(':pass', $password);

			      	if ($stmt -> execute()) {
						$_COOKIE['user'] = null; # Después de que el usuario restablece su contraseña limpiamos la cookie declarando la variable null.
					  	$message = '¡Se ha enviado a tu correo tu nueva contraseña!';
					} else {
					 	$message2 = '¡No se ha podido restablecer la contraseña!';
					}
			    } else {
			      	$message2 = 'Datos incorrectos';
			    }
		    } else {
		      	$message2 = 'El usuario no existe. <a href="sign_up.php">Regístrate</a>';
		    }
		}
	}
	
	// Validamos que el usuario que quiere recuperar la contraseña exista en la BD
	if (isset($_POST['user'])){
		$user = $_POST['user'];
		
		if (!empty($user)) {
			$records = $conn -> prepare('SELECT * FROM users WHERE name = :name');

			$records -> bindParam(':name', $user);
			$records -> execute();
			$results = $records->fetch(PDO::FETCH_ASSOC);

			if (is_countable($results) > 0) {
				setcookie("user", $user); # Creamos la COOKIE que contendra el nombre del usuario, que nos servira después para hacer una consulta sql en el archivo validacion.php
				header("Location:  ../PI/validacion.php");
			} else {
				$message2 = 'El usuario no existe. <a href="sign_up.php">Regístrate</a>';
			}
		}
	}

	// Validamos que la COOKIE se haya creado correctamente para poder mostrar la pregunta de seguridad sin necesidad de que el usuario la ponga, esto por el posible escenario donde se le olvidé la pregunta.
	if (isset($_COOKIE['user'])) { # Validamos que la variable $_COOKIE['user'] tiene un valor 
		$records = $conn->prepare('SELECT * FROM users WHERE name = :name'); # Preparamos una sentencia sql SELECT
		$records->bindParam(':name', $_COOKIE['user']); # Definimos cual va ser el valor de :name
		$records->execute(); # Ejecutamos la sentecncia SQL
		$results = $records->fetch(PDO::FETCH_ASSOC); # Obtenemos los datos de la bd (PDO::FETCH_ASSOC: devuelve un array indexado por los nombres de las columnas del conjunto de resultados.) y le asignamos la variable $result a los datos obtenidos.

		$users = null; # Creamos una variable $users y establecemos que su valor es null

		if (count($results) > 0) { # Validamos que el array indexado $results tenga valores 
			$users = $results; # Establecemos que la variable $user contendra los valores del array $results para usarlo después en validacion.php
		}
	}	

?>


<?php 

	require 'db.php';

	# Declaramos las variables que vamos a utilizar, esto con el fin de que no aparezca el warning de variable indefinida.
	$user = "";
	$pass = "";
	$question = "";
	$respuesta = "";
	$message = "";
	$message2 = "";
	$correo = "";

	if (isset($_POST['name']) && !isset($_POST['pregunta'])) { # Validamos que exista un valor en $_POST['name'] y que no exista nigun valor en $_POST['pregunta'].
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
		      	if ($results['name'] == 'Administrador'){ # Validadmos que sea la cuenta de administrador.
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
	} else if (isset($_POST['correo'])){
		$user = $_POST['name'];
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

			      	$password = password_hash($newpass, PASSWORD_BCRYPT);
			      	$stmt -> bindParam(':pass', $password);

			      	if ($stmt -> execute()) {
					  	$message2 = '¡Se ha enviado a tu correo una nueva contraseña';
					} else {
					 	$message2 = '¡No se ha podido restablecer la contraseña!';
					}
			    } else {
			      	$message2 = 'Datos incorrectos';
			    }
		    } else {
		      $message2 = 'El usuario no existe';
		    }
		}
	}
?>
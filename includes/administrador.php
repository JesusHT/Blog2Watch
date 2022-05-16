<?php 
  	require 'db.php';
  	
	# Declaración de variables 
	$titulo = "";
	$info = "";
	$plataforma = "";
	$tipo = "";
	$message = "";

	# Crear publicaciones
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
				$message = '<p class="bg-red fw-bold text-white p-1">Ya existe una publicación con ese titulo</p>';
			} else {
				$sql = $conn -> prepare('INSERT INTO post (titulo, info, plataforma, tipo) VALUES (:titulo, :info, :plataforma, :tipo)');
		
				$sql -> bindParam(':titulo', $titulo);
				$sql -> bindParam(':info', $info);
				$sql -> bindParam(':plataforma', $plataforma);
				$sql -> bindParam(':tipo', $tipo);
			
				$message = $stmt -> execute() ? '<p class="bg-green fw-bold text-white p-1">¡Publicación subida exitoxamente!</p>' : '<p class="bg-red fw-bold text-white p-1">¡No se ha podido subir la publicación!</p>';
			}
		}
	}

	# Eliminar publicaciones
	if(isset($_POST['eliminar'])){
		$sql = $conn -> prepare('DELETE FROM post WHERE id_post = :id_post');
		$sql-> bindParam(':id_post', $_POST['eliminar']);
		$sql -> execute();
	} 

	# Mostrar buzon
	$sqlComment = $conn -> prepare('SELECT * FROM buzon ORDER BY id_buzon DESC');
	$sqlComment -> execute();
	$comments = $sqlComment -> fetchAll(PDO::FETCH_OBJ);
	
	# Eliminar usuarios
	if(isset($_POST['eliminar-user'])){
		$sql = "DELETE FROM users WHERE id = :id";
		$stmt = $conn -> prepare($sql);
		$stmt -> bindParam(':id', $_POST['eliminar-user']);

		$data = $stmt -> execute() ? '¡Se elimino exitosamente!' : '¡No se ha podido eliminar!';

		die(json_encode($data));
	} 

?>
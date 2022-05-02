<?php 
  require 'db.php';
  
	$titulo = "";
	$info = "";
	$plataforma = "";
	$tipo = "";
	$message = "";
	$message2 = "";

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

	
	$sql = "SELECT * FROM buzon ORDER BY id_buzon DESC";

	$query2 = $conn -> prepare($sql);
	$query2 -> execute();
	$comentarios = $query2 -> fetchAll(PDO::FETCH_OBJ);


	if(isset($_POST['eliminar-user'])){
		$sql = "DELETE FROM users WHERE id = :id";
		$stmt = $conn -> prepare($sql);
		$stmt -> bindParam(':id', $_POST['eliminar-user']);
		$stmt -> execute();
	} 

	
	$sql_2 = "SELECT * FROM users";

	$query3 = $conn -> prepare($sql_2);
	$query3 -> execute();
	$usuarios = $query3 -> fetchAll(PDO::FETCH_OBJ);

?>
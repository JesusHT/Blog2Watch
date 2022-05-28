<?php 
  	require 'db.php';
  	
	# Declaración de variables 
	$titulo = "";
	$info = "";
	$plataforma = "";
	$type = "";
	$message = "";
	$editar = "";
	$duracion = "";
	$duracion2 = "";
	$duracion3 = "";
	$extreno = "";
	$id_post = "";

	# Crear publicaciones
	if (isset($_POST['title']) && isset($_POST['info']) && isset($_POST['plataforma']) && isset($_POST['tipo']) && isset($_POST['duracion']) || isset($_POST['duracion2']) && isset( $_POST['extreno']) && isset($_POST['calificacion'])) {
		$titulo = $_POST['title'];
		$info = $_POST['info'];
		$plataforma = $_POST['plataforma'];
		$type = $_POST['tipo'];
		$extreno = $_POST['extreno'];
		$calificacion = $_POST['calificacion'];

		if (isset($_POST['duracion'])) {
			$duracion = $_POST['duracion'];
		} else {
			$duracion = $_POST['duracion2'];
		}

		if (!empty($titulo) && !empty($info) && !empty($plataforma) && !empty($type) && !empty($calificacion) && !empty($extreno) && !empty($duracion) || !empty($duracion2)){
			$records = $conn -> prepare('SELECT * FROM post WHERE titulo = :titulo');
			$records -> bindParam(':titulo', $titulo);
			$records -> execute();
			$results = $records -> fetch(PDO::FETCH_ASSOC);
	
			if (is_countable($results) > 0) {
				$message = '<p class="bg-red fw-bold text-white p-1">Ya existe una publicación con ese titulo</p>';
			} else {
				$sql = $conn -> prepare('INSERT INTO post (titulo, info, plataforma, tipo, calificacion, extreno, duracion) VALUES (:titulo, :info, :plataforma, :tipo, :calificacion, :extreno, :duracion)');
		
				$sql -> bindParam(':titulo', $titulo);
				$sql -> bindParam(':info', $info);
				$sql -> bindParam(':plataforma', $plataforma);
				$sql -> bindParam(':tipo', $type);
				$sql -> bindParam(':extreno', $extreno);
				$sql -> bindParam(':duracion', $duracion);
				$sql -> bindParam(':calificacion', $calificacion);
			
				$message = $sql -> execute() ? '<p class="bg-green fw-bold text-white p-1">¡Publicación subida exitoxamente!</p>' : '<p class="bg-red fw-bold text-white p-1">¡No se ha podido subir la publicación!</p>';
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

	# Formulario Editar
	if (isset($_POST['editar'])) {
		$editar = $_POST['editar'];
		if (!empty($editar)) {
			$records = $conn -> prepare('SELECT * FROM post WHERE id_post = :id_post');
			$records->bindParam(':id_post', $editar);
			$records->execute();
			$results = $records -> fetch(PDO::FETCH_ASSOC);
			$plataforma = ["Netflix","Amazon","Disney+","HBO","Otro"];
			$tipo = ["¿Cómo conseguiste que saliera esta opción?","Serie","Pelicula"];

			if (is_countable($results)>0) {
				$data = '<form action="index-administrador.php" method="POST" id="formul"> 
							<input type="hidden" name="id_editar" value="'. $results['id_post'] .'">

							<div class="form-floating mb-3">
								<input type="text" name="title" value="'. $results['titulo'] .'" class="form-control bg-dark text-white" id="floatingInput" placeholder="..." maxlength="100" required>
								<label for="floatingInput">Titulo</label>
							</div>

							<div class="form-floating mb-3 ">
								<textarea type="text" name="info" class="form-control bg-dark text-white" style="height: 100px" id="floatingInput" placeholder="info" minlength="6" maxlength="500" required>'. $results['info'] .'</textarea>
								<label for="floatingInput">Información</label>
							</div>

							<div class="row g-2">
								<div class="form-floating mb-3 col-6">
									<select class="form-select bg-dark text-white"  id="floatingSelect" aria-label="Floating label select example" name="plataforma" required>
										<option value="'. $results['plataforma'] .'" selected disabled>'. $plataforma[$results['plataforma'] - 1] .'</option>
										<option value="1">Netflix</option>
										<option value="2">Amazon Prime</option>
										<option value="3">Disney+</option>
										<option value="4">HBO</option>
										<option value="5">Otro</option>
									</select>
									<label for="floatingSelect">Plataforma</label>	
								</div>

								<div class="form-floating mb-3 col-6">
									<select class="form-select bg-dark text-white" id="tipo1" id="floatingSelect" aria-label="Floating label select example" name="tipo" required>
										<option value="'. $results['tipo'] .'" selected disabled>'. $tipo[$results['tipo']] .'</option>
										<option value="2">Pelicula</option>
										<option value="1">Serie</option>
									</select>
									<label for="floatingSelect">Tipo</label>	
								</div>
							</div>
							<div class="row g-2">
								
								<div class="col-6 form-floating mb-3">
									<input type="number" name="extreno" value="'. $results['extreno'] .'" class="form-control bg-dark text-white" max="2022" id="floatingInput" placeholder="..." required>
									<label for="floatingInput">Año de extreno</label>
								</div>

								<div class="col-6 form-floating mb-3">
									<input class="form-control bg-dark text-white" name="duracion3" value="'. $results['duracion'] .'" type="text" id="floatingInput" placeholder="...">
									<label for="floatingInput">Duración y/o temporada</label>
								</div>

							</div>
							<div class="form-floating mb-3">
								<input type="number" name="calificacion" value="'. $results['calificacion'] .'" min="0" max="5" id="floatingInput" class="form-control bg-dark text-white" placeholder="..." required>
								<label for="floatingInput">Calificación</label>
							</div>
							<input class="btn button-submit2 text-white rounded border-white border-1" type="submit" value="Actualizar">
						</form>';
			} else {
				$data = '<p class="bg-red fw-bold text-white p-1">¡No se ha podido editar la publicación!</p>';
			}

		}
		die(json_encode($data));
	}

	# Editar publicaciones

	if (isset($_POST['id_editar'])) {
		$titulo = $_POST['title'];
		$info = $_POST['info'];
		$plataforma = $_POST['plataforma'];
		$type = $_POST['tipo'];
		$duracion3 = $_POST['duracion3'];
		$extreno = $_POST['extreno'];
		$calificacion = $_POST['calificacion'];
		$id_post = $_POST['id_editar'];

		if (!empty($titulo) && !empty($info) && !empty($plataforma) && !empty($type) && !empty($duracion3) && !empty($extreno) && !empty($calificacion)) {
			$sql = $conn -> prepare('UPDATE post SET titulo = :titulo, info = :info, plataforma = :plataforma, tipo = :tipo, extreno = :extreno, duracion = :duracion, calificacion = :calificacion WHERE id_post = :id_post');
		
			$sql -> bindParam(':titulo', $titulo);
			$sql -> bindParam(':info', $info);
			$sql -> bindParam(':plataforma', $plataforma);
			$sql -> bindParam(':tipo', $type);
			$sql -> bindParam(':extreno', $extreno);
			$sql -> bindParam(':duracion', $duracion3);
			$sql -> bindParam(':calificacion', $calificacion);
			$sql -> bindParam(':id_post', $id_post);
			
			$message = $sql -> execute() ? '<p class="bg-green fw-bold text-white p-1">¡Publicación actualizada exitoxamente!</p>' : '<p class="bg-red fw-bold text-white p-1">¡No se ha podido actualizar la publicación!</p>';
		}
	}

?>
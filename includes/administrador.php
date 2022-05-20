<?php 
  	require 'db.php';
  	
	# Declaración de variables 
	$titulo = "";
	$info = "";
	$plataforma = "";
	$tipo = "";
	$message = "";
	$editar = "";
	$colors = ["text-darkPurple","text-darkBlue","text-red","text-blue"];
    $bg = ["#610094","#05387b","darkred","#0296d6"];
	global $conn;

	# Funciones 
	function mostrarCom($id_post){
        global $conn;
        if(true){
            $sql = "SELECT * FROM comments WHERE id_post = {$id_post}";
            $querycom = $conn -> prepare($sql);
            $querycom -> execute(); 

            return $querycom -> fetchAll(PDO::FETCH_OBJ); 
        } 
    }

	# Mostrar tabla publicaciones
	$sql = $conn -> prepare("SELECT * FROM post ORDER BY id_post DESC");
	$sql -> execute();
	$publicaciones = $sql -> fetchAll(PDO::FETCH_OBJ); 

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
							<div class="form-floating mb-3">
								<input type="text" value="'. $results['titulo'] .'" class="form-control bg-dark text-white" id="floatingInput" placeholder="title" name="title" maxlength="100" required>
								<label for="floatingInput">Titulo</label>
							</div>

							<div class="form-floating mb-3 ">
								<textarea type="text" name="info" class="form-control bg-dark text-white" style="height: 100px" id="floatingInput" placeholder="info" minlength="6" maxlength="500" required>'. $results['info'] .'</textarea>
								<label for="floatingInput">Información</label>
							</div>

							<div class="row g-2">
								<div class="form-floating mb-3 col-6">
									<select class="form-select bg-dark text-white"  id="floatingSelect" aria-label="Floating label select example" name="plataforma" required>
										<option selected disabled>'. $plataforma[$results['plataforma'] - 1] .'</option>
										<option value="1">Netflix</option>
										<option value="2">Amazon Prime</option>
										<option value="3">Disney+</option>
										<option value="4">HBO</option>
										<option value="5">Otro</option>
									</select>
									<label for="floatingSelect">Plataforma</label>	
								</div>
								<div class="form-floating mb-3 col-6">
									<select class="form-select bg-dark text-white" id="floatingSelect" aria-label="Floating label select example" name="tipo" required>
										<option selected disabled>'. $tipo[$results['tipo']] .'</option>
										<option value="2">Pelicula</option>
										<option value="1">Serie</option>
									</select>
									<label for="floatingSelect">Tipo</label>	
								</div>
							</div>
							<input class="button-submit2 text-white mb-3 rounded border-white border-1" type="submit" value="Subir">
						</form>';
			} else {
				$data = '<p class="bg-red fw-bold text-white p-1">¡No se ha podido editar la publicación!</p>';
			}

		}
		die(json_encode($data));
	}

?>
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
    $data = "";

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
                $data = '<p class="bg-red fw-bold text-white p-1">Ya existe una publicación con ese titulo</p>';
                echo json_encode($data);
            } else {
                $sql = $conn -> prepare('INSERT INTO post (titulo, info, plataforma, tipo, calificacion, extreno, duracion) VALUES (:titulo, :info, :plataforma, :tipo, :calificacion, :extreno, :duracion)');
        
                $sql -> bindParam(':titulo', $titulo);
                $sql -> bindParam(':info', $info);
                $sql -> bindParam(':plataforma', $plataforma);
                $sql -> bindParam(':tipo', $type);
                $sql -> bindParam(':extreno', $extreno);
                $sql -> bindParam(':duracion', $duracion);
                $sql -> bindParam(':calificacion', $calificacion);
            
                $data = $sql -> execute() ? '<p class="bg-green fw-bold text-white p-1">¡Publicación subida exitoxamente!</p>' : '<p class="bg-red fw-bold text-white p-1">¡No se ha podido subir la publicación!</p>';
                echo json_encode($data);
            }
        }
    }

    # Eliminar publicaciones
	if(isset($_POST['eliminar'])){
		$sql = $conn -> prepare('DELETE FROM post WHERE id_post = :id_post');
		$sql-> bindParam(':id_post', $_POST['eliminar']);
		$sql -> execute();
        $data = "todo okay";
        echo json_encode($data);
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
			
			$data = $sql -> execute() ? '<p class="bg-green fw-bold text-white p-1">¡Publicación actualizada exitoxamente!</p>' : '<p class="bg-red fw-bold text-white p-1">¡No se ha podido actualizar la publicación!</p>';
            echo json_encode($data);
		}
	}
?>
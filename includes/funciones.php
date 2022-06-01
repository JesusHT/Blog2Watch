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
    $duracion3 = "";
    $extreno = "";
    $id_post = "";
    $calificacion = 0;
    $data = "";

    # Crear publicaciones
    if (isset($_POST['title']) && isset($_POST['info']) && isset($_POST['plataforma']) && isset($_POST['tipo']) && isset( $_POST['extreno']) && isset($_POST['duracion'])) {
        $titulo = $_POST['title'];
        $info = $_POST['info'];
        $plataforma = $_POST['plataforma'];
        $type = $_POST['tipo'];
        $extreno = $_POST['extreno'];
        $duracion = $_POST['duracion'];

        if (!empty($titulo) && !empty($info) && !empty($plataforma) && !empty($type) && !empty($extreno) && !empty($duracion)){
            $records = $conn -> prepare('SELECT * FROM post WHERE titulo = :titulo');
            $records -> bindParam(':titulo', $titulo);
            $records -> execute();
            $results = $records -> fetch(PDO::FETCH_ASSOC);

            if (!empty($results)) {
                $data = '<p class="bg-red fw-bold text-white p-1 rounded">Ya existe una publicación con ese titulo</p>';
                echo json_encode($data);
            } else {
                $sql = $conn -> prepare('INSERT INTO post (titulo, info, plataforma, tipo, calificacion, extreno, duracion) VALUES (:titulo, :info, :plataforma, :tipo, :calificacion, :extreno, :duracion)');
        
                $sql -> bindParam(':titulo', $titulo);
                $sql -> bindParam(':info', $info);
                $sql -> bindParam(':plataforma', $plataforma);
                $sql -> bindParam(':tipo', $type);
                $sql -> bindParam(':extreno', $extreno);
                $sql -> bindParam(':calificacion', $calificacion);
                $sql -> bindParam(':duracion', $duracion);
            
                $data = $sql -> execute() ? '<p class="bg-green fw-bold text-white p-1 rounded">¡Publicación subida exitoxamente!</p>' : '<p class="bg-red fw-bold text-white p-1">¡No se ha podido subir la publicación!</p>';
                echo json_encode($data);
            }
        }
    }

    # Eliminar publicaciones
	if(isset($_POST['eliminar'])){
        $sql = $conn -> prepare('DELETE FROM comments WHERE id_post = :id_post');
		$sql-> bindParam(':id_post', $_POST['eliminar']);
		$sql -> execute();

		$sql = $conn -> prepare('DELETE FROM post WHERE id_post = :id_post');
		$sql-> bindParam(':id_post', $_POST['eliminar']);
		$sql -> execute();
        
        $data = "todo okay";
        echo json_encode($data);
	}

    # Eliminar comentarios
    if(isset($_POST['id_comment'])){
		$sql = $conn -> prepare('DELETE FROM comments WHERE id_comment = :id_comment');
		$sql-> bindParam(':id_comment', $_POST['id_comment']);
		$sql -> execute();
        $data = "todo okay";
        echo json_encode($data);
	}

    #Elminar buzón 
    if(isset($_POST['id_buzon'])){
		$sql = $conn -> prepare('DELETE FROM buzon WHERE id_buzon = :id_buzon');
		$sql-> bindParam(':id_buzon', $_POST['id_buzon']);
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
		$id_post = $_POST['id_editar'];

		if (!empty($titulo) && !empty($info) && !empty($plataforma) && !empty($type) && !empty($duracion3) && !empty($extreno)) {
			$sql = $conn -> prepare('UPDATE post SET titulo = :titulo, info = :info, plataforma = :plataforma, tipo = :tipo, extreno = :extreno, duracion = :duracion WHERE id_post = :id_post');
		
			$sql -> bindParam(':titulo', $titulo);
			$sql -> bindParam(':info', $info);
			$sql -> bindParam(':plataforma', $plataforma);
			$sql -> bindParam(':tipo', $type);
			$sql -> bindParam(':extreno', $extreno);
			$sql -> bindParam(':duracion', $duracion3);
			$sql -> bindParam(':id_post', $id_post);
			
			$data = $sql -> execute() ? '<p class="bg-green fw-bold text-white p-1">¡Publicación actualizada exitoxamente!</p>' : '<p class="bg-red fw-bold text-white p-1">¡No se ha podido actualizar la publicación!</p>';
            echo json_encode($data);
		}
	}

    # Insertar reacciones
    if (isset($_POST['id_user']) && isset($_POST['id_post']) && isset($_POST['calificacion'])){
        $query = $conn -> prepare('SELECT * FROM reactions WHERE id_post = :id_post AND id_user = :id_user');
        $query -> bindParam(':id_user', $_POST['id_user']);
        $query -> bindParam(':id_post', $_POST['id_post']);
        $query -> execute();
        $query = $query -> fetch(PDO::FETCH_ASSOC);

        if (!empty($query) > 0) {
            $sql = $conn -> prepare('UPDATE reactions SET calificacion = :calificacion WHERE id_reaction = :id_reaction');
		
	        $sql -> bindParam(':calificacion', $_POST['calificacion']);
			$sql -> bindParam(':id_reaction', $query['id_reaction']);

            $data = $sql -> execute() ? "Todo okay" : "Todo mal";
            echo json_encode($data);
        } else {
            $sql = $conn -> prepare('INSERT INTO reactions (id_post, id_user, calificacion) VALUES (:id_post, :id_user, :calificacion)');
        
            $sql -> bindParam(':id_post', $_POST['id_post']);
            $sql -> bindParam(':id_user', $_POST['id_user']);
            $sql -> bindParam(':calificacion', $_POST['calificacion']);

            $data = $sql -> execute() ? "Todo okay" : "Todo mal";
            echo json_encode($data);
        }
    }
?>
<?php 
  require 'db.php';

  $idPost = "";
  $idUser = "";
  $comment = "";

  //Comentarios
  if(isset($_POST['comment'])){
    $idPost = $_POST['id_post'];
    $idUser = $_POST['id_user'];
    $comment = $_POST['comment'];

    if (!empty($comment)) {
			$sql = "INSERT INTO comments (id_post, id_user, comment) VALUES (:id_post, :id_user, :comment)";
				$stmt = $conn -> prepare($sql);
		
				$stmt -> bindParam(':id_post', $id_post);
				$stmt -> bindParam(':id_user', $id_user);
				$stmt -> bindParam(':comment', $comment);
		}
  }

  //Reacciones
  
?>
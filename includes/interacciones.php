<?php 
  require 'db.php';

  $id_post = "";
  $id_user = "";
  $comment = "";

  //Comentarios
  if(isset($_POST['comment'])){
    $id_post = $_POST['id_post'];
    $id_user = $_POST['id_user'];
    $comment = $_POST['comment'];

    if (!empty($comment)) {
			$sql = "INSERT INTO comments (id_post, id_user, comment) VALUES (:id_post, :id_user, :comment)";
			$stmt = $conn -> prepare($sql);
		
			$stmt -> bindParam(':id_post', $id_post);
			$stmt -> bindParam(':id_user', $id_user);
			$stmt -> bindParam(':comment', $comment);

			$stmt -> execute();

			$_POST['id_post'] = null;
			$_POST['id_user'] = null;
			$_POST['comment'] = null;
		}
  }

  //Reacciones
?>
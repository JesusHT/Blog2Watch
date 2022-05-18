<?php 
  require 'db.php';

  $id_post = "";
  global $id_post;
  $id_user = "";
  $comment = "";

  //Comentarios
  if(isset($_POST['comment'])){
    global $id_post;
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

  //Mostrar comentarios
  if($com = true){
    //$query="select * form post_comment where post_id=".$post_id;
    //SELECT * FROM `comments` WHERE id_post = 5 ORDER BY id_comment ASC; 
    $sql = "SELECT * FROM comments /**WHERE id_post = .$id_post*/";
    $querycom = $conn -> prepare($sql); #query variable"conn" -> 
    $querycom -> execute(); #ejecutar
    $resultscom = $querycom -> fetchAll(PDO::FETCH_OBJ); 
  }

  //Reacciones
?>
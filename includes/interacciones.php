<?php 
  require 'db.php';

function mostrarCom($id_post)
{
  global $conn;
  //Mostrar comentarios
  if(/**$com = */true){
    $sql = "SELECT * FROM comments WHERE id_post = {$id_post}";
    $querycom = $conn -> prepare($sql); #query variable"conn" -> 
    $querycom -> execute(); #ejecutar
    return $querycom -> fetchAll(PDO::FETCH_OBJ); 
  } 
}


  $id_post = "";
  $id_user = "";
  $comment = "";

  session_start();
  //Comentarios
  if(isset($_POST['comment']) && isset($_SESSION['user_id'])){
    $id_post = $_POST['id_post'];
    $comment = $_POST['comment'];
    
    if (!empty($comment) && !empty($id_post)) {
			$sql = $conn -> prepare("INSERT INTO comments (id_post, id_user, comment) VALUES (:id_post, :id_user, :comment)");
		
			$sql -> bindParam(':id_post', $id_post);
			$sql -> bindParam(':id_user', $_SESSION['user_id']);
			$sql -> bindParam(':comment', $comment);

      $data = $sql -> execute() ? "Todo bien" : "Oh no, qué le moviste ya no sirve ctrl + z rapidooo!!!!";

      echo json_encode($data);
		}
    
  }
<<<<<<< Updated upstream
  
  //Mostrar comentarios
  if($com = true){
    //$query="select * form post_comment where post_id=".$post_id;
    //SELECT * FROM `comments` WHERE id_post = 5 ORDER BY id_comment ASC; 
    $sql = "SELECT * FROM comments /**WHERE id_post = .$id_post*/";
    $querycom = $conn -> prepare($sql); #query variable"conn" -> 
    $querycom -> execute(); #ejecutar
    $resultscom = $querycom -> fetchAll(PDO::FETCH_OBJ); 
  }
=======

>>>>>>> Stashed changes

  //Reacciones
?>
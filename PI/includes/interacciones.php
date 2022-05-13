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
		}
  }

  //Otro para comentarios
  error_reporting(0); // For not showing any error

if (isset($_POST['submit'])) { // Check press or not Post Comment Button
	$id_post = $_POST['id_post']; // Get Name from form
	$id_user = $_POST['id_user']; // Get Email from form
	$comment = $_POST['comment']; // Get Comment from form

	$sql = "INSERT INTO comments (id_post, id_user, comment)
			VALUES ('$id_post', '$id_user', '$comment')";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>alert('Comment added successfully.')</script>";
	} else {
		echo "<script>alert('Comment does not add.')</script>";
	}
}

  //Reacciones
  
?>
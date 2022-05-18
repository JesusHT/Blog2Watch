<?php 
    require 'db.php';
    
    $sql = $conn -> prepare("SELECT * FROM post ORDER BY id_post DESC");
	$sql -> execute();
	$publicaciones = $sql -> fetchAll(PDO::FETCH_OBJ); 

    echo json_encode($publicaciones);
    
?>
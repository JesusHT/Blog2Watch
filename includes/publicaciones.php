<?php 
    require 'db.php';

    # Definir variables
    $id_post = "";
    $name = "";
    $comment = "";
    
    global $conn;
    
    $sql = $conn -> prepare("SELECT * FROM post ORDER BY id_post DESC");
	$sql -> execute();
	$publicaciones = $sql -> fetchAll(PDO::FETCH_OBJ); 

    $colors = ["text-darkPurple","text-darkBlue","text-red","text-blue"];
    $bg = ["#610094","#05387b","darkred","#0296d6"];

    function mostrarCom($id_post){
        global $conn;
        if(true){
            $sql = "SELECT * FROM comments WHERE id_post = {$id_post}";
            $querycom = $conn -> prepare($sql);
            $querycom -> execute(); 

            return $querycom -> fetchAll(PDO::FETCH_OBJ); 
        } 
    }

    //Comentarios
    if(isset($_POST['comment'])){
        $id_post = $_POST['id_post'];
        $name = $_POST['user'];
        $comment = $_POST['comment'];
        
        if (!empty($comment)){
                $sql = "INSERT INTO comments (id_post, name, comment) VALUES (:id_post, :name, :comment)";
                $stmt = $conn -> prepare($sql);
            
                $stmt -> bindParam(':id_post', $id_post);
                $stmt -> bindParam(':name', $name);
                $stmt -> bindParam(':comment', $comment);
                $stmt -> execute();
            }
    }
?>
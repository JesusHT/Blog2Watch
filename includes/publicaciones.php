<?php 
    require 'db.php';

    # Definir variables
    $id_post = "";
    $name = "";
    $comment = "";
    $plataformas = null;

    global $conn;
    
    $sql = "SELECT * FROM post ORDER BY id_post DESC";

    if(isset($_POST['plataforma'])){
        $plataformas = $_POST['plataforma'];
        if (!empty($plataformas) && $plataformas != 5) {
            $sql = "SELECT * FROM post WHERE plataforma = {$plataformas} ORDER BY id_post DESC";
        } else if (empty($plataformas) || $plataformas == 5) {
            $sql = "SELECT * FROM post ORDER BY id_post DESC";
        }
    }

    $query = $conn -> prepare($sql);
	$query -> execute();
	$publicaciones = $query -> fetchAll(PDO::FETCH_OBJ); 

    $colors = ["text-red","text-blue","text-darkBlue","text-darkPurple"];
    $bg = ["red","rgb(28, 137, 157)","rgb(6, 51, 136)","rgb(66, 17, 181)"];

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
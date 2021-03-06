<?php

    session_start();

    require 'db.php';
    # Validar si el usuario inicio sesión
    if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT * FROM users WHERE id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (count($results) > 0) {
            $user = $results;
        }
    } else {
        header('Location: ../login.php'); 
    }

?>
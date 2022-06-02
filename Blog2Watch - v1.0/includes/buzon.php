<?php
    require "db.php";
    $data = "";
    # Mostrar buzon
	$sqlComment = $conn -> prepare('SELECT * FROM buzon ORDER BY id_buzon DESC');
	$sqlComment -> execute();
	$comments = $sqlComment -> fetchAll(PDO::FETCH_OBJ);

    $tipos = ["#198754","#ffca2c","red"];
    $icons = ['<i class="fa-solid fa-badge-check"></i>', '<i class="fa-solid fa-circle-exclamation"></i>', '<i class="fa-solid fa-skull-crossbones"></i>'];

    if($sqlComment -> rowCount() > 0) { 
        foreach($comments as $buzon) {
            if($comments[0] -> id_buzon == $buzon -> id_buzon){
                $data .= '<button class="btn nav-link active" style="background-color:'. $tipos[$buzon -> tipo_mensaje - 1] .'!important;" id="user'. $buzon -> id_buzon .'-tab" data-bs-toggle="pill" data-bs-target="#user'. $buzon -> id_buzon .'" type="button" role="tab" aria-controls="user-'. $buzon -> id_buzon .'" aria-selected="true"><b>'. $icons[$buzon -> tipo_mensaje - 1] .'</b></xc></button>';
            } else {
                $data .= '<button class="btn nav-link" style="background-color:'. $tipos[$buzon -> tipo_mensaje - 1] .'!important;" id="user'. $buzon -> id_buzon .'-tab" data-bs-toggle="pill" data-bs-target="#user'. $buzon -> id_buzon .'" type="button" role="tab" aria-controls="user-'. $buzon -> id_buzon .'" aria-selected="false"><b>'. $icons[$buzon -> tipo_mensaje - 1] .'</b></button>';
            }
        }

        $data .= '<button type="button" onclick="actualizar()" class="btn submit bg-dark text-white border-radius border-white mt-3" title="Actualizar buzón"><i class="fa-solid fa-arrows-rotate"></i></button>';
        echo json_encode($data);
    }
?>


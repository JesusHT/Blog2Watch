<?php 
    require 'db.php';

    # Definir variables
    $id_post = "";
    $name = "";
    $comment = "";
    $plataformas = 5;
    $fecha = 1;
    $tipo = 3;
    $cont = 0;
    $contVotos = 0;
    $calificacion = 0;
    $data = "";

    global $conn;
    
    # Mostrar comentarios
    function mostrarCom($id_post){
        global $conn;
        if(true){
            $sql = "SELECT * FROM comments WHERE id_post = {$id_post}";
            $querycom = $conn -> prepare($sql);
            $querycom -> execute(); 

            return $querycom -> fetchAll(PDO::FETCH_OBJ); 
        } 
    }
    function contarReacctions($id_post){
        global $conn;
        if(true){
            $sql = "SELECT * FROM reactions WHERE id_post = {$id_post}";
            $querycom = $conn -> prepare($sql);
            $querycom -> execute(); 

            return $querycom -> fetchAll(PDO::FETCH_OBJ); 
        } 
    }
    function mostrarReactions($id_post, $id_user){
        global $conn;
        if(true){
            $sql = "SELECT * FROM reactions WHERE id_post = {$id_post} AND id_user = {$id_user}";
            $queryreac = $conn -> prepare($sql);
            $queryreac -> execute(); 

            return $queryreac -> fetchAll(PDO::FETCH_OBJ); 
        } 
    }

    $sql = "SELECT * FROM post ORDER BY id_post DESC";

    if(isset($_POST['plataforma']) && isset($_POST['fecha']) && isset($_POST['tipo'])){
        $plataformas = $_POST['plataforma'];
        $fecha = $_POST['fecha'];
        $tipo = $_POST['tipo']; 

        if ($plataformas != 5) {
           switch ($fecha){
                case 1:
                    if ($tipo != 3) {
                        $sql = "SELECT * FROM post  WHERE plataforma = {$plataformas} AND tipo = {$tipo} ORDER BY id_post DESC";
                    } else {
                        $sql = "SELECT * FROM post  WHERE plataforma = {$plataformas} ORDER BY id_post DESC";
                    }
                    break;
                case 2:
                    if ($tipo != 3) {
                        $sql = "SELECT * FROM post  WHERE plataforma = {$plataformas} AND tipo = {$tipo} ORDER BY id_post ASC";
                    } else {
                        $sql = "SELECT * FROM post  WHERE plataforma = {$plataformas} ORDER BY id_post ASC";
                    }
                    break;
            }
        } else {
            switch ($fecha){
                case 1:
                    if ($tipo != 3) {
                        $sql = "SELECT * FROM post  WHERE tipo = {$tipo} ORDER BY id_post DESC";
                    } else {
                        $sql = "SELECT * FROM post ORDER BY id_post DESC";
                    }
                    break;
                case 2:
                    if ($tipo != 3) {
                        $sql = "SELECT * FROM post WHERE tipo = {$tipo} ORDER BY id_post ASC";
                    } else {
                        $sql = "SELECT * FROM post ORDER BY id_post ASC";
                    }
                    break;
            }
        }
    }

    
    $query = $conn -> prepare($sql);
	$query -> execute();
	$publicaciones = $query -> fetchAll(PDO::FETCH_OBJ); 

    $colors = ["text-red","text-blue","text-darkBlue","text-darkPurple"];
    $bg = ["red","rgb(28, 137, 157)","rgb(6, 51, 136)","rgb(66, 17, 181)"];
	$plataforma = ["Netflix","Amazon Prime","Disney+","HBO","Otro"];

    session_start();
    
    if($query -> rowCount() > 0) { 
        foreach($publicaciones as $publicacion) {
            $data .= '<div class="row border rounded-3 mb-3 position-center" style="border-color:'. $bg[$publicacion -> plataforma - 1] .'!important;">
                        <div class="col-md-12 mt-3"> <h3 class="text-white fw-bold">'. $publicacion -> titulo.'</h3></div>
                        <div class="row g-2 text-white">';

            if ($publicacion -> tipo == 1){
                $data .= '  <div class="col-6">
                                <p class="pl-2 mt-3"><b>Plataforma: '. $plataforma[$publicacion -> plataforma -1] .'</b></p>
                            </div>
                            <div class="col-6 text-end">
                                <p><b>'.  $publicacion -> duracion .' temporadas.</b><br><b>'.  $publicacion -> extreno .'</b></p>
                            </div>';
                            
            } else{
                $data .= '  <div class="col-6">
                                <p class="pl-2 mt-2"><b>Plataforma: '. $plataforma[$publicacion -> plataforma -1] .'</b></p>
                            </div>
                            <div class="col-6 text-end">
                                <p><b>'.  $publicacion -> duracion .' minutos.</b><br><b>'.  $publicacion -> extreno .'</b></p>
                            </div>';
            }
                            
            $data .= '</div>
                        <post-info class="info-post mt-2 col-md-12 text-white"><p>'. $publicacion -> info.'</p></post-info>
                        <div class="row g-2"><div class="col-6 text-white">';
            $contarReacciones = contarReacctions($publicacion -> id_post);
            if (!empty($contarReacciones)){
                foreach ($contarReacciones as $contar){
                   if ($contar -> id_post == $publicacion -> id_post) {
                        $contVotos++;
                        $cont = $cont + $contar -> calificacion;
                        $calificacion = $cont/$contVotos;
                    }
                }
                $data .= '<p class="pl-2"><b>Votos: </b>'. $contVotos .' <b>Calificación: </b>'. round($calificacion, 2, PHP_ROUND_HALF_UP) .'/5</p>';
                
                $querypost = $conn -> prepare( "UPDATE post SET calificacion = {$calificacion} WHERE id_post = {$publicacion -> id_post}");
                $querypost -> execute(); 

                $contVotos = 0;
                $cont = 0;
                $calificacion = 0;
            } else {
                $data .= '<p class="pl-2"><b>Votos: </b> 0 <b>Calificación: </b> 0/5</p>';
            }
            
            if (isset($_SESSION['user_id'])) {
                $records = $conn->prepare('SELECT * FROM users WHERE id = :id');
                $records->bindParam(':id', $_SESSION['user_id']);
                $records->execute();
                $results = $records->fetch(PDO::FETCH_ASSOC);
        
                $user = null;
        
                if (count($results) > 0) {
                    $user = $results;
                }
                $data .= '</div>
                        <div class="col-6">
                        <form id="formReactions'. $publicacion -> id_post .'">
                            <input type="hidden" name="id_post" value="'. $publicacion -> id_post .'">
                            <input type="hidden" name="id_user" value="'. $user['id'] .'">
                            <p class="clasificacion">';
                $reaciones = mostrarReactions($publicacion -> id_post, $user['id']);
                if (!empty($reaciones)){
                    foreach ($reaciones as $reacion) {
                        switch($reacion -> calificacion){
                            case 1:
                                $data .= '<input id="radio1'. $publicacion -> id_post .'" type="radio" name="calificacion" value="5" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio1'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio2'. $publicacion -> id_post .'" type="radio" name="calificacion" value="4" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio2'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio3'. $publicacion -> id_post .'" type="radio" name="calificacion" value="3" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio3'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio4'. $publicacion -> id_post .'" type="radio" name="calificacion" value="2" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio4'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio5'. $publicacion -> id_post .'" type="radio" name="calificacion" value="1" onclick="mostrarReacciones('. $publicacion -> id_post .')" checked>
                                            <label for="radio5'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>';
                                break;
                            case 2:
                                $data .= '<input id="radio1'. $publicacion -> id_post .'" type="radio" name="calificacion" value="5" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio1'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio2'. $publicacion -> id_post .'" type="radio" name="calificacion" value="4" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio2'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio3'. $publicacion -> id_post .'" type="radio" name="calificacion" value="3" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio3'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio4'. $publicacion -> id_post .'" type="radio" name="calificacion" value="2" onclick="mostrarReacciones('. $publicacion -> id_post .')" checked>
                                            <label for="radio4'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio5'. $publicacion -> id_post .'" type="radio" name="calificacion" value="1" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio5'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>';
                                break;
                            case 3:
                                $data .= '<input id="radio1'. $publicacion -> id_post .'" type="radio" name="calificacion" value="5" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio1'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio2'. $publicacion -> id_post .'" type="radio" name="calificacion" value="4" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio2'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio3'. $publicacion -> id_post .'" type="radio" name="calificacion" value="3" onclick="mostrarReacciones('. $publicacion -> id_post .')" checked>
                                            <label for="radio3'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio4'. $publicacion -> id_post .'" type="radio" name="calificacion" value="2" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio4'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio5'. $publicacion -> id_post .'" type="radio" name="calificacion" value="1" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio5'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>';
                                break;
                            case 4:
                                $data .= '<input id="radio1'. $publicacion -> id_post .'" type="radio" name="calificacion" value="5" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio1'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio2'. $publicacion -> id_post .'" type="radio" name="calificacion" value="4" onclick="mostrarReacciones('. $publicacion -> id_post .')" checked>
                                            <label for="radio2'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio3'. $publicacion -> id_post .'" type="radio" name="calificacion" value="3" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio3'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio4'. $publicacion -> id_post .'" type="radio" name="calificacion" value="2" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio4'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio5'. $publicacion -> id_post .'" type="radio" name="calificacion" value="1" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio5'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>';
                                break;
                            case 5:
                                $data .= '<input id="radio1'. $publicacion -> id_post .'" type="radio" name="calificacion" value="5" onclick="mostrarReacciones('. $publicacion -> id_post .')" checked>
                                            <label for="radio1'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio2'. $publicacion -> id_post .'" type="radio" name="calificacion" value="4" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio2'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio3'. $publicacion -> id_post .'" type="radio" name="calificacion" value="3" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio3'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio4'. $publicacion -> id_post .'" type="radio" name="calificacion" value="2" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio4'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                            <input id="radio5'. $publicacion -> id_post .'" type="radio" name="calificacion" value="1" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                            <label for="radio5'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>';
                                break;
                        }
                    }      
                } else {
                    $data .=   '<input id="radio1'. $publicacion -> id_post .'" type="radio" name="calificacion" value="5" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                <label for="radio1'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                <input id="radio2'. $publicacion -> id_post .'" type="radio" name="calificacion" value="4" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                <label for="radio2'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                <input id="radio3'. $publicacion -> id_post .'" type="radio" name="calificacion" value="3" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                <label for="radio3'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                <input id="radio4'. $publicacion -> id_post .'" type="radio" name="calificacion" value="2" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                <label for="radio4'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                <input id="radio5'. $publicacion -> id_post .'" type="radio" name="calificacion" value="1" onclick="mostrarReacciones('. $publicacion -> id_post .')">
                                <label for="radio5'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>';
                }
                $data .= '  </p>
                          </form>
                          </div>';
            } else {
                $data .= '</div>
                        <div class="col-6">
                        <form id="formReactions">
                            <p class="clasificacion">
                                <input id="radio1'. $publicacion -> id_post .'" type="radio" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <label for="radio1'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                <input id="radio2'. $publicacion -> id_post .'" type="radio" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <label for="radio2'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                <input id="radio3'. $publicacion -> id_post .'" type="radio" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <label for="radio3'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                <input id="radio4'. $publicacion -> id_post .'" type="radio" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <label for="radio4'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                                <input id="radio5'. $publicacion -> id_post .'" type="radio" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <label for="radio5'. $publicacion -> id_post .'"><i class="fa-solid fa-popcorn"></i></label>
                            </p>
                        </form>
                        </div>';
            }

            $data .= '  </div>
                        <post-comment class="col-md-12">
                            <div class="col-md-12">
							    <div class="body-comment mb-2 text-white">';
            $comentarios = mostrarCom($publicacion -> id_post);
            if (!empty($comentarios)) {
                foreach($comentarios as $comentario) {
                    $data .= '      <p class="text-name-comment">'. $comentario -> name. '</p>
                                    <p class="text-comment">'.  $comentario -> comment .'</p>';
                }   
            }
           if (isset($_SESSION['user_id'])) {
                $records = $conn->prepare('SELECT * FROM users WHERE id = :id');
                $records->bindParam(':id', $_SESSION['user_id']);
                $records->execute();
                $results = $records->fetch(PDO::FETCH_ASSOC);
        
                $user = null;
        
                if (count($results) > 0) {
                    $user = $results;
                }
                $data .= '	 </div>
                        </div>
                        <form id="formComment'. $publicacion -> id_post.'">
                            <div class="input-group mb-3">
                                <input type="hidden" name="user" id="user" value="'. $user['name'] .'">
                                <input type="hidden" name="id_post" id="id_post" value="'. $publicacion -> id_post .'">
                                <textarea type="text" name="comment" id="comment'.  $publicacion -> id_post .'" class="form-control h-comment bg-dark text-white" placeholder="Escribir comentario..."></textarea>
                                <button type="button" class="btn btn-outline-secondary submit-comment text-white" id="enviar" onclick="enviarDatos('. $publicacion -> id_post .')">
                                    <i class="fa-solid fa-message"></i>
                                </button>
                            </div>
                        </form>
                    </post-comment></div>';
           } else {
                $data .= '	 </div>
                        </div>
                        <form id="formComment'. $publicacion -> id_post.'">
                            <div class="input-group mb-3">
                                <input type="hidden" name="user" id="user" value="">
                                <input type="hidden" name="id_post" id="id_post" value="'. $publicacion -> id_post .'">
                                <textarea type="text" name="comment" id="comment'.  $publicacion -> id_post .'" class="form-control h-comment bg-dark text-white" placeholder="Escribir comentario..."></textarea>
                                <button type="button" class="btn btn-outline-secondary submit-comment text-white" id="enviar" onclick="limpiar('. $publicacion -> id_post .')" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <i class="fa-solid fa-message"></i>
                                </button>
                            </div>
                        </form>
                    </post-comment></div>';
           }
                            
        }
        echo json_encode($data);
    }

    # Guardar comentarios
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
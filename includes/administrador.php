<?php 
  	require 'db.php';

	$data = "";
	$bg = ["red","rgb(28, 137, 157)","rgb(6, 51, 136)","rgb(66, 17, 181)"];
	$tipo = ["Serie", "Pelicula"];
	$plataforma = ["Netflix","Amazon Prime","Disney+","HBO","Otro"];
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

	$query = $conn -> prepare("SELECT * FROM post ORDER BY id_post DESC");
	$query -> execute();
	$publicaciones = $query -> fetchAll(PDO::FETCH_OBJ); 

    if($query -> rowCount() > 0) { 
        foreach($publicaciones as $publicacion) {
            $data .= ' <div class="accordion-item bg-dark border-white border mb-3">
							<div class="row g-2">
								<div class="col-10">
									<h2 class="accordion-header" id="flush-heading'. $publicacion -> id_post.'">
										<button type="button" class="accordion-button collapsed text-white" data-bs-toggle="collapse" data-bs-target="#flush-collapse'. $publicacion -> id_post.'" aria-expanded="false" aria-controls="flush-collapse'. $publicacion -> id_post.'" style="background:'. $bg[$publicacion -> plataforma - 1] .';">
											'. $publicacion -> titulo .'
										</button>
									</h2>
								</div>
								<div class="col-2 btn-group justify-content-end">
									<form id="formDelete'. $publicacion -> id_post .'">
										<input type="hidden" name="eliminar" value="'. $publicacion -> id_post.'">
										<button type="button" class="submit bg-dark text-white" onclick="deletePost('. $publicacion -> id_post.')"><i class="fa-solid fa-trash-can"></i></button>	
									</form>
									<form action="" method="POST" id="updatePost'. $publicacion -> id_post.'">
										<input type="hidden" name="editar" value="'. $publicacion -> id_post.'">
										<button type="button" class="submit bg-dark text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="updatePost('. $publicacion -> id_post.')"><i class="fa-solid fa-pencil"></i></button>
									</form>
								</div>
							</div>
							<div id="flush-collapse'. $publicacion -> id_post.'" class="accordion-collapse collapse" aria-labelledby="flush-heading'. $publicacion -> id_post.'" data-bs-parent="#accordionFlushPublications">
								<div class="accordion-body">
									<p class="text-white"><b>Plataforma: </b>'. $plataforma[$publicacion -> plataforma - 1] .'<br><b>Tipo: </b>'. $tipo[$publicacion -> tipo - 1] .'<br><b>Calificación: </b>'. $publicacion -> calificacion .'/5</p>
									<p class="text-white text-justify"><b>Información: </b>'. $publicacion -> info.'</p>
									<p class="text-white text-justify"><b>Comentarios: </b></p><hr style="background:'. $bg[$publicacion -> plataforma - 1] .';height: 5px; ">';
			$comentarios = mostrarCom($publicacion -> id_post);
				if (!empty($comentarios)) {
					foreach($comentarios as $comentario) {
						$data .= '    <form id="deleteComment'. $publicacion -> id_post + $comentario -> id_comment .'">
										<input type="hidden" name="id_comment" value="'.  $comentario -> id_comment . '">
										<div class="row g-2">
											<div class="col-10">
												<p class="text-white text-name-comment">'. $comentario -> name. '</p>
												<p class="text-white text-comment">'.  $comentario -> comment .'</p>
											</div>
											<div class="col-2 btn-group  justify-content-end">
												<button type="button" class="submit bg-dark text-white" onclick="deleteComment('. $publicacion -> id_post + $comentario -> id_comment .')"><i class="fa-solid fa-trash-can"></i></button>	
											</div>
										</div>
									</form>';
					}   
				}
			$data .= '			</div>
							</div>
						</div>';
                            
        }
        echo json_encode($data);
    }
?>
<?php
    require "db.php";
    $data = "";
    # Mostrar buzon'.  -> id_buzon .'
	$sqlComment = $conn -> prepare('SELECT * FROM buzon ORDER BY id_buzon DESC');
	$sqlComment -> execute();
	$comments = $sqlComment -> fetchAll(PDO::FETCH_OBJ);

    $tipos = ["Sugerencia","Queja","Reportar error"];

    if($sqlComment -> rowCount() > 0) { 
        foreach($comments as $buzon) {
            if($comments[0] -> id_buzon == $buzon -> id_buzon){
                $data .= '<div class="tab-pane fade show active" id="user'. $buzon -> id_buzon .'" role="tabpanel" aria-labelledby="user'. $buzon -> id_buzon .'-tab">
                            <div class="border rounded-2 border-white p-2">
                                <div class="col-12">
                                    <p class="text-white"><b>Usuario: </b>'. $buzon -> users .'<br><b>Tipo de mensaje: </b>'. $tipos[$buzon -> tipo_mensaje - 1] .'</p>
                                    <p class="text-white text-justify b-word">'. $buzon -> mensaje .'</p>
                                </div>
                                <div class="col-12"  align="right">
                                    <form id="formDeleteBuzon'. $buzon -> id_buzon .'">
                                        <input type="hidden" name="id_buzon" value="'. $buzon -> id_buzon .'">
                                        <button type="button" class="submit bg-dark text-white" onclick="deleteBuzon('. $buzon -> id_buzon .')"><i class="fa-solid fa-trash-can"></i> Borrar</button>	
                                    </form>
                                </div>
                            </div>
                          </div>';
            } else {
                $data .= '<div class="tab-pane fade" id="user'. $buzon -> id_buzon .'" role="tabpanel" aria-labelledby="user'. $buzon -> id_buzon .'-tab">
                            <div class="border rounded-2 border-white p-2">
                                <div class="col-12">
                                    <p class="text-white"><b>Usuario: </b>'. $buzon -> users .'<br><b>Tipo de mensaje: </b>'. $tipos[$buzon -> tipo_mensaje - 1] .'</p>
                                    <p class="text-white text-justify b-word">'. $buzon -> mensaje .'</p>
                                </div>
                                <div class="col-12" align="right">
                                    <form id="formDeleteBuzon'. $buzon -> id_buzon .'">
                                        <input type="hidden" name="id_buzon" value="'. $buzon -> id_buzon .'">
                                        <button type="button" class="submit bg-dark text-white" onclick="deleteBuzon('. $buzon -> id_buzon .')"><i class="fa-solid fa-trash-can"></i> Borrar </button>	
                                    </form>
                                </div>
                            </div>
                          </div>';
            }
        }
        echo json_encode($data);
    }
?>


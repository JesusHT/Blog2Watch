<?php
    require 'db.php';

    # Formulario Editar
    if (isset($_POST['editar'])) {
        $editar = $_POST['editar'];
        if (!empty($editar)) {
            $records = $conn -> prepare('SELECT * FROM post WHERE id_post = :id_post');
            $records -> bindParam(':id_post', $editar);
            $records -> execute();
            $results = $records -> fetch(PDO::FETCH_ASSOC);
           
            $plataforma = ["Netflix","Amazon","Disney+","HBO","Otro"];
            $tipo = ["¿Cómo conseguiste que saliera esta opción?","Serie","Pelicula"];

            if (!empty($results)) {
                $data = '<div class="mt-2" id="respuetaUpdate"></div>
                        <form id="formUpdate"> 
                            <input type="hidden" name="id_editar" value="'. $results['id_post'] .'">

                            <div class="form-floating mb-3">
                                <input type="text" name="title" value="'. $results['titulo'] .'" class="form-control bg-dark text-white" id="floatingInput" placeholder="..." maxlength="100" required>
                                <label for="floatingInput">Titulo</label>
                            </div>

                            <div class="form-floating mb-3 ">
                                <textarea type="text" name="info" class="form-control bg-dark text-white" style="height: 100px" id="floatingInput" placeholder="info" minlength="6" required>'. $results['info'] .'</textarea>
                                <label for="floatingInput">Información</label>
                            </div>

                            <div class="row g-2">
                                <div class="form-floating mb-3 col-6">
                                    <select class="form-select bg-dark text-white"  id="floatingSelect" aria-label="Floating label select example" name="plataforma" required>
                                        <option value="'. $results['plataforma'] .'" selected>'. $plataforma[$results['plataforma'] - 1] .'</option>
                                        <option value="1">Netflix</option>
                                        <option value="2">Amazon Prime</option>
                                        <option value="3">Disney+</option>
                                        <option value="4">HBO</option>
                                        <option value="5">Otro</option>
                                    </select>
                                    <label for="floatingSelect">Plataforma</label>	
                                </div>

                                <div class="form-floating mb-3 col-6">
                                    <select class="form-select bg-dark text-white" id="tipo1" id="floatingSelect" aria-label="Floating label select example" name="tipo" required>
                                        <option value="'. $results['tipo'] .'" selected>'. $tipo[$results['tipo']] .'</option>
                                        <option value="2">Pelicula</option>
                                        <option value="1">Serie</option>
                                    </select>
                                    <label for="floatingSelect">Tipo</label>	
                                </div>
                            </div>
                            <div class="row g-2">
                                
                                <div class="col-6 form-floating mb-3">
                                    <input type="number" name="extreno" value="'. $results['extreno'] .'" class="form-control bg-dark text-white" max="2022" id="floatingInput" placeholder="..." required>
                                    <label for="floatingInput">Año de estreno</label>
                                </div>

                                <div class="col-6 form-floating mb-3">
                                    <input class="form-control bg-dark text-white" name="duracion3" value="'. $results['duracion'] .'" type="text" id="floatingInput" placeholder="...">
                                    <label for="floatingInput">Duración y/o temporada</label>
                                </div>

                            </div>
                            <button type="button" class="btn button-submit2 text-white rounded border-white border-1" onclick="postUpdate('. $results['id_post'] .')">Actualizar</button>
                        </form>';
            } else {
                $data = '<p class="bg-red fw-bold text-white p-1">¡No se ha podido editar la publicación!</p>';
            }

        }
        die(json_encode($data));
    }
?>
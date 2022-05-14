<?php
    require 'db.php';
	
	# Definir las variables 
    $fecha = 3;
    $tipo = 3;
    $relevancia = 3;
    $sql = "SELECT * FROM post ORDER BY id_post DESC";

	#if determina que las variables post si existe (un valor) 
	if (isset($_POST['fecha']) && isset($_POST['relevancia']) && isset($_POST['tipo'])) {
		$fecha = $_POST['fecha']; #dentro de los corchetes estara las variables que definieron en los imput
	    $tipo = $_POST['tipo'];
	    $relevancia = $_POST['relevancia'];		

	    if ($fecha == 3 || $fecha == 1) { #if si fecha es igual 3 o igual a 1 
			switch($tipo){
				case 1:
					$sql = "SELECT * FROM post WHERE tipo='1' ORDER BY id_post DESC";
					break;
				case 2:
					$sql = "SELECT * FROM post WHERE tipo='2' ORDER BY id_post DESC";
					break;
				case 3:
					$sql = "SELECT * FROM post ORDER BY id_post DESC"; #poner de manera descendente las publicaciones 
					break;
			}	
	    } else {
	    	switch($tipo){
				case 1:
					$sql = "SELECT * FROM post WHERE tipo='1' ORDER BY id_post ASC";
					break;
				case 2:
					$sql = "SELECT * FROM post WHERE tipo='2' ORDER BY id_post ASC";
					break;
				case 3:
					$sql = "SELECT * FROM post ORDER BY id_post ASC"; #poner de manera descendente las publicaciones 
					break;
			}	
	    }
	}

	$query = $conn -> prepare($sql); #query variable"conn" -> 
	$query -> execute(); #ejecutar
	$results = $query -> fetchAll(PDO::FETCH_OBJ);

?>

<acordion-filtered class="acordion-item" id="accordionExample">
	<a class="text-filtered btn" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-controls="collapseOne" ><img src="resources/pictures/filtrar.png" width="30" height="30">FILTROS</a>
	<div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
		<div class="body-filtered section-filtered text-section-filtered row hr-filterd mt-2">
			<section-filtered class="col-md-12">
				<form action="" method="POST">
					<div class="row">
						<div class="col-4 mt-2 mb-3">
							TIPO<hr>  <!-- sub indices o categorias -->
							<input type="radio" value="1" name="tipo" id="1" <?php if ($tipo == 1){ echo "checked";}?>> <!-- radio sirve para que el usuario elija una opcion por categoria, php cumple la condicion significa que el radio esta seleccionado  -->
							<label for="1">Series</label>
							<br>
							<input type="radio" value="2" name="tipo" id="2" <?php if ($tipo == 2){ echo "checked";}?>> 
							<label for="2">Peliculas</label>
							<br>
							<input type="radio" value="3" name="tipo" id="3" <?php if ($tipo == 3){ echo "checked";}?>>
							<label for="3">Todo</label>
						</div>
						<div class="col-4 mt-2 mb-3">
							ORDENAR POR<hr>
							<input type="radio" value=1 name="relevancia" id="4" <?php if ($relevancia == 1){ echo "checked";}?>> 
							<label for="4">Más relevante</label>
							<br>
							<input type="radio" value="2" name="relevancia" id="5" <?php if ($relevancia == 2){ echo "checked";}?>>
							<label for="5">Menos relevante</label>
							<br>
							<input type="radio" value="3" name="relevancia" id="6" <?php if ($relevancia == 3){ echo "checked";}?>>
							<label for="6">Todo</label>
						</div>
						<div class="col-4 mt-2 mb-3">
							FECHA DE CARGA<hr>
							<input type="radio" value="1" name="fecha" id="7" <?php if ($fecha == 1 || $fecha == 3){ echo "checked";}?>>
							<label for="7">Más reciente</label>
							<br>
							<input type="radio" value="2" name="fecha" id="8" <?php if ($fecha == 2){ echo "checked";}?>>
							<label for="8">Menos reciente</label>
						</div>
					</div>
					<input type="submit" value="Aplicar"> <!-- boton para que el usuario pueda ver que es lo que quiere -->
				</form>
				<form action="" method="POST">
					<input type="hidden" name="normal">
					<input type="submit" value="Reiniciar"> <!-- boton para renicia -->
				</form>
			</section-filtered>
		</div>
	</div>
</acordion-filtered>
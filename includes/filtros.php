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
	<a class="text-filtered btn text-white" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-controls="collapseOne" ><img src="resources/pictures/filtrar.png" width="30" height="30">FILTROS</a>
	<div id="collapseOne" class="accordion-collapse collapse mt-3" data-bs-parent="#accordionExample">
		<div class="body-filtered section-filtered fw-bold text-white row hr-filterd">
			<section-filtered class="col-md-12">
				<form action="" method="POST" id="filtros">
					<div class="row g-3">
						<div class="col-4 mt-2 mb-3">
							TIPO<hr>
							<input type="radio" value="1" name="tipo" id="series">
							<label for="series">Series</label>
							<br>
							<input type="radio" value="2" name="tipo" id="peliculas"> 
							<label for="peliculas">Peliculas</label>
							<br>
							<input type="radio" value="3" name="tipo" id="todo">
							<label for="todo">Todo</label>
						</div>
						<div class="col-4 mt-2 mb-3">
							ORDENAR POR<hr>
							<input type="radio" value=1 name="relevancia" id="masRelevante"> 
							<label for="masRelevante">Más relevante</label>
							<br>
							<input type="radio" value="2" name="relevancia" id="menosRelevante">
							<label for="menosRelevante">Menos relevante</label>
							<br>
							<input type="radio" value="3" name="relevancia" id="todoRelevancia">
							<label for="todoRelevancia">Todo</label>
						</div>
						<div class="col-4 mt-2 mb-3">
							FECHA DE CARGA<hr>
							<input type="radio" value="1" name="fecha" id="masReciente">
							<label for="masReciente">Más reciente</label>
							<br>
							<input type="radio" value="2" name="fecha" id="menosReciente">
							<label for="menosReciente">Menos reciente</label>
						</div>
					</div>
					<button type="button" onclick="">Aplicar</button>
					<button type="button" onclick="">Reiniciar</button>
				</form>
			</section-filtered>
		</div>
	</div>
</acordion-filtered>
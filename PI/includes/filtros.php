<?php

    require 'db.php';

    $fecha = 3;
    $tipo = 3;
    $relevancia = 3;

    $sql = "SELECT * FROM post ORDER BY id_post DESC";

	if (isset($_POST['fecha'])) {
		$fecha = $_POST['fecha'];
		
		if ($fecha == 3 || $fecha == 1) {
			$sql = "SELECT * FROM post ORDER BY id_post DESC";
		} else {
			$sql = "SELECT * FROM post ORDER BY id_post ASC";
		}	
	}

	$query = $conn -> prepare($sql);
	$query -> execute();
	$results = $query -> fetchAll(PDO::FETCH_OBJ);

?>

<acordion-filtered class="acordion-item" id="accordionExample">
	<a class="text-filtered btn" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-controls="collapseOne" ><img src="Imagenes\filtrar.png" width="30" height="30">FILTROS</a>
	<div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
		<div class="body-filtered section-filtered text-section-filtered row hr-filterd filtered mt-2">
			<section-filtered class="col-md-4">TIPO<hr>
				<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" id="form1">
					<input type="radio" id="1" name="tipo" value="1" <?php if ($tipo == 1){ echo "checked";}?> onclick="document.getElementById('form1').submit()">
                    <label for="1" onclick="document.getElementById('form1').submit()"> Serie</label><br>
				    <input type="radio" id="2" name="tipo" value="2" <?php if ($tipo == 2){ echo "checked";}?> onclick="document.getElementById('form1').submit()">
                    <label for="2" onclick="document.getElementById('form1').submit()"> Peliculas</label><br>
                    <input type="radio" id="3" name="tipo" value="3" <?php if ($tipo == 3){ echo "checked";}?> onclick="document.getElementById('form1').submit()">
                    <label for="3" onclick="document.getElementById('form1').submit()"> Todo </label>
				</form>
			</section-filtered>
			<section-filtered class="col-md-4">ORDENAR POR<hr>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" id="form2">
                    <input type="radio" id="4" name="relevancia" value="1" <?php if ($relevancia == 1){ echo "checked";}?> onclick="document.getElementById('form2').submit()">
                    <label for="4" onclick="document.getElementById('form2').submit()"> Más relevante</label><br>
                    <input type="radio" id="5" name="relevancia" value="2" <?php if ($relevancia == 2){ echo "checked";}?> onclick="document.getElementById('form2').submit()">
                    <label for="5" onclick="document.getElementById('form2').submit()"> Menos relevante</label><br>
                    <input type="radio" id="6" name="relevancia" value="3" <?php if ($relevancia == 3){ echo "checked";}?> onclick="document.getElementById('form2').submit()">
                    <label for="6" onclick="document.getElementById('form2').submit()"> Todo </label>
                </form>
			</section-filtered>
			<section-filtered class="col-md-4">FECHA DE CARGA<hr>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" id="form3">
                    <input type="radio" id="7" name="fecha" <?php if ($fecha == 1 || $fecha == 3){ echo "checked";}?> value="1" onclick="document.getElementById('form3').submit()">
                    <label for="7" onclick="document.getElementById('form3').submit()"> Más reciente</label><br>
                    <input type="radio" id="8" name="fecha" <?php if ($fecha == 2){ echo "checked";}?>  value="2" onclick="document.getElementById('form3').submit()">
                    <label for="8" onclick="document.getElementById('form3').submit()"> Menos reciente</label>
                </form>
			</section-filtered>
		</div>
	</div>
</acordion-filtered>
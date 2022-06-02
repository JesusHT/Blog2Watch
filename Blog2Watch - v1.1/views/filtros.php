<acordion-filtered class="acordion-item" id="accordionExample">
	<button class="btn text-white" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-controls="collapseOne"><i class="fa-solid fa-filter"></i> FILTROS</button>
	<div id="collapseOne" class="accordion-collapse collapse mt-2" data-bs-parent="#accordionExample">
		<form method="POST" id="filtros">
			<div class="row row g-2 text-white">
				<div class="col-6 mt-2 mb-3">
					<p>TIPO</p><hr>  <!-- sub indices o categorias -->
					<div class="form-check form-switch">
						<input class="form-check-input" type="radio" name="tipo" id="flexSwitchCheckSeries" value="1">
						<label class="form-check-label" for="flexSwitchCheckSeries">Series</label>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="radio" name="tipo" id="flexSwitchCheckPeliculas" value="2">
						<label class="form-check-label" for="flexSwitchCheckPeliculas">Peliculas</label>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="radio" name="tipo" id="flexSwitchCheckTodo" value="3" checked>
						<label class="form-check-label" for="flexSwitchCheckTodo">Todo</label>
					</div>
				</div>
				<div class="col-6 mt-2 mb-3">
					<p>FECHA DE CARGA</p><hr>
					<div class="form-check form-switch">
						<input class="form-check-input" type="radio" name="fecha" id="flexSwitchCheckMasReciente"  value="1" checked>
						<label class="form-check-label" for="flexSwitchCheckMasReciente">Más reciente</label>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="radio" name="fecha" id="flexSwitchCheckMenosReciente" value="2">
						<label class="form-check-label" for="flexSwitchCheckMenosReciente">Menos reciente</label>
					</div>
				</div>
			</div>
			<button type="button" onclick="filtros()" id="submit" class="btn text-white bg-darkRed bg-gradient"> Aplicar </button>
		</form>
		<button type="button" onclick="reset()" id="reset" class="btn text-white bg-darkRed bg-gradient mt-2" style="display:none;"> Borrar </button>
	</div>
</acordion-filtered>
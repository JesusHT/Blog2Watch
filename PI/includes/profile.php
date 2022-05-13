<style>
	.body-acordion {
    	background-color: #610094;
		color: #fff;
	}
	.accordion-button:not(.collapsed) {
	    color: #fff;
	    background-color: #610094;
	}
	.bg-item{
		background-color: #3d0859;
	}
	.perfil-img {
		max-width: 150px;
	}
	.input-profile {
		background-color: #610094;
		border-color: #000000;
		color: #fff;
	}
	.input-profile:focus {
		background-color: #610094;
		color: #fff;
		border-color: #000000;
	}
	.bg-option:checked {
	  background-color: #3d0859;
	}
	.w-submit {
		width: 100px;
	}
	.logout {
		color: #fff;
	}
</style>

<div class="row g-2 mt-4">
	<div class="col-4">
		<div class="row">
			<div class="card bg-dark" style="width: 18rem;">
			  	<img src="Imagenes/perfil.png" class="card-img-top perfil-img d-block mx-auto">
			  	<div class="card-body">
			   		<p class="card-text text-center"><?php if (!empty($user)){ echo $user['name']; } ?></p>
			  	</div>
			</div>
		</div>
	</div>
	<div class="col-8">
		<div class="accordion accordion-flush mb-4" id="accordionFlushExample">
		  <div class="accordion-item mb-4 bg-item">
		    <h2 class="accordion-header" id="flush-headingOne">
		      <button class="accordion-button collapsed body-acordion" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
		        Cambiar contraseña
		      </button>
		    </h2>
		    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
		      <div class="accordion-body bg-item">
		      	<form action="" method="POST">
		      		<div class="form-floating mb-3">
						<input class="form-control input-profile" type="password" name="actualPass" minlength="6" maxlength="20" required id="floatingPassword" placeholder="Password">
						<label for="floatingPassword"><span><i class="bi bi-lock-fill"></i></span> Contraseña actual</label>
					</div>
					<div class="form-floating mb-3">
						<input class="form-control input-profile" id="pass" type="password" name="newPass" minlength="6" maxlength="20" required id="floatingPassword" placeholder="Password">
						<label for="floatingPassword"><span><i class="bi bi-lock-fill"></i></span> Nueva Contraseña <p class="coincide" id="demo"></p></label>
					</div>
					<div class="form-floating mb-3">
						<input class="form-control input-profile" id="newPassConfirm" type="password" name="pass-confirm" minlength="6" maxlength="20" required id="floatingPassword" placeholder="Password">
						<label for="floatingPassword"><span><i class="bi bi-lock-fill"></i></span> Confirmar nueva contraseña <p class="coincide" id="demo2"></p></label>
					</div>	
		      		<input type="hidden" name="id_user" value="<?php echo $user['id']; ?>">
					<input type="submit" class="w-submit bg-dark bg-gradient text-white" value="Guardar">
		      	</form>
		      </div>
		    </div>
		  </div>
		  <div class="accordion-item">
		    <h2 class="accordion-header" id="flush-headingTwo">
		      <button class="accordion-button collapsed body-acordion" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
		        Cambiar pregunta y respuesta de seguridad 
		      </button>
		    </h2>
		    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
		      <div class="accordion-body bg-item">
		      	<form action="" method="post">
		      		<input type="hidden" name="id_user" value="<?php echo $user['id']; ?>">	
					<div class="form-floating mb-3">
						<select class="form-select align-input input-profile" id="floatingSelect" aria-label="Floating label select example" name="newPregunta" required>
							<option class="bg-option" selected disabled>Elija una pregunta</option>
							<option class="bg-option" value="1">¿Cuál es el nombre de mi mascota?</option>
							<option class="bg-option" value="2">¿Cuál es mi canción favorita?</option>
							<option class="bg-option" value="3">¿Cuál es mi videojuego favorito?</option>
						</select>
						<label for="floatingSelect"><i class="bi bi-question-lg"></i> Pregunta de seguridad</label>				
					</div>
					<div class="form-floating mb-3">
						<input class="form-control input-profile" type="text" name="newRespuesta" minlength="3" maxlength="20" required id="floatingResponse" placeholder="respuesta">
						<label for="floatingResponse"><i class="bi bi-chat-right-text-fill"></i> Respuesta</label>
					</div>
					<input type="submit" class="w-submit bg-dark bg-gradient text-white" value="Guardar">
		      	</form>
		      </div>
		    </div>
		  </div>
		</div>
		<button type="button" class="logout bg-item" onclick="location.href='includes/logout.php'">
			<i class="bi bi-box-arrow-right"></i> Cerrar sesión
		</button>
	</div>
</div>
<style>
	.accordion-button:not(.collapsed) {
	    background-color: #610094;
	}
	.perfil-img {
		max-width: 150px;
	}
	.input-profile {
		background-color: #610094;
		border-color: #000000;
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
</style>

<div class="row mt-4">
	<div class="col-4">
		<div class="row">
			<div class="card bg-dark" style="width: 18rem;">
			  	<img src="resources/img/perfil.png" class="card-img-top perfil-img d-block mx-auto">
			  	<div class="card-body">
			   		<p class="card-text text-center text-white"><?php if (!empty($user)){ echo $user['name']; } ?></p>
			  	</div>
			</div>
		</div>
	</div>
	
	<div class="col-8">
		<div class="accordion accordion-flush mb-4" id="accordionFlushExample">
		  <div class="accordion-item mb-4 bg-darkPurple">
		    <h2 class="accordion-header" id="flush-headingOne">
		      <button class="accordion-button collapsed bg-purple text-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
		        Cambiar contraseña
		      </button>
		    </h2>
		    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
		      <div class="accordion-body text-white bg-darkPurple">
		      	<form action="" method="POST" id="newPassword">
		      		<div class="form-floating mb-3">
						<input class="form-control input-profile text-white" type="password" id="passActual" name="actualPass" minlength="6" maxlength="20" required id="floatingPassword" placeholder="Password">
						<label for="floatingPassword"><span><i class="fa-solid fa-lock"></i></span> Contraseña actual</label>
					</div>	
					<div class="form-floating mb-3">
						<input class="form-control input-profile text-white" id="pass" type="password" name="newPass" minlength="6" maxlength="20" required id="floatingPassword" placeholder="Password">
						<label for="floatingPassword"><span><i class="fa-solid fa-lock-keyhole"></i></span> Nueva Contraseña <span id="demo"></span></label>
					</div>
					<div class="form-floating mb-3">
						<input class="form-control input-profile text-white" id="pass-confirm" type="password" name="pass-confirm" minlength="6" maxlength="20" id="floatingPassword" placeholder="Password" required>
						<label for="floatingPassword"><span><i class="fa-solid fa-lock-keyhole"></i></span> Confirmar nueva contraseña <span id="demo2"></span></label>
					</div>	
		      		<input type="hidden" name="id_user" value="<?php echo $user['id']; ?>">
					<button type="button" class="btn w-submit bg-dark bg-gradient text-white" id="enviar" onclick="newPassword()">Guardar</button>
		      	</form>
		      </div>
		    </div>
		  </div>
		  <div class="accordion-item">
		    <h2 class="accordion-header" id="flush-headingTwo">
		      <button class="accordion-button collapsed bg-purple text-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
		        Cambiar pregunta y respuesta de seguridad 
		      </button>
		    </h2>
		    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
		    <form action="" method="post" id="newPregunta">
		      	<div class="accordion-body bg-darkPurple text-white">
		      		<input type="hidden" name="id_user" value="<?php echo $user['id']; ?>">	
					<div class="form-floating mb-3">
						<input class="form-control input-profile text-white" type="password" id="pass-actual" name="pass" minlength="6" maxlength="20" required id="floatingPassword" placeholder="Password">
						<label for="floatingPassword"><span><i class="fa-solid fa-lock-keyhole"></i></span> Contraseña</label>
					</div>
					<div class="form-floating mb-3">
						<select class="form-select align-input input-profile text-white" id="selectPregunta" id="floatingSelect" aria-label="Floating label select example" name="newPregunta" required>
							<option class="bg-option" selected disabled>Elija una pregunta</option>
							<option class="bg-option" value="1">¿Cuál es el nombre de mi mascota?</option>
							<option class="bg-option" value="2">¿Cuál es mi canción favorita?</option>
							<option class="bg-option" value="3">¿Cuál es mi videojuego favorito?</option>
						</select>
						<label for="floatingSelect"><i class="fa-solid fa-block-question"></i> Pregunta de seguridad</label>				
					</div>
					<div class="form-floating mb-3">
						<input class="form-control input-profile text-white" type="text" name="newRespuesta" id="respuesta" minlength="3" maxlength="20" required id="floatingResponse" placeholder="respuesta">
						<label for="floatingResponse"><i class="fa-thin fa-comment-minus"></i> Respuesta</label>
					</div>
					<button type="button" class="btn w-submit bg-dark bg-gradient text-white" onclick="newPreguntas()">Guardar</button>
		      	</div>
		     </form>
		    </div>
		  </div>
		</div>
		<button type="button" class="btn text-white bg-darkPurple bg-gradient" onclick="location.href='includes/logout.php'">
			<i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar sesión
		</button>
	</div>
</div>
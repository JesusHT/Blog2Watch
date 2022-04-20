<div class="ventana-terms" id="vent">
			<div class="row">
				<div class="col-md-12" align="right">
					<a href="javascript:close()" class="cerrar"><i class="bi bi-x-circle-fill"></i></a>
				</div>
				<div class="col-md-12 dark">
					<form method="POST" action="includes/users.php">
						<div class="form-floating mt-2">
							<input class="align-input form-control" type="text" name="name" required id="floatingInput" placeholder="username">
							<label for="floatingInput"><span><i class="bi bi-person-fill"></i></span> Usuario</label>
						</div>
						<div class="form-floating">
							<input class="align-input form-control" type="email" name="correo" required id="floatingEmail" placeholder="Correo">
							<label for="floatingEmail"><i class="bi bi-envelope-fill"></i> Correo</label>
						</div>
						<div class="form-floating">
							<input class="align-input form-control" type="text" value="" id="floatingPregunta" placeholder="question" readonly="readonly">
							<label for="floatingPregunta"><i class="bi bi-question-lg"></i> Pregunta de seguridad</label>				
						</div>
						<div class="form-floating">
							<input class="align-input form-control" type="text" name="respuesta" minlength="3" maxlength="20" required id="floatingResponse" placeholder="respuesta">
							<label for="floatingResponse"><i class="bi bi-chat-right-text-fill"></i> Respuesta</label>
						</div>
						<input class="button-submit align-input" type="submit" value="Continuar"> 
					</form>
				</div>
			</div>
		</div>
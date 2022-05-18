/* USUARIO REGISTRADO */

     $(cargarPublicacion());
     function cargarPublicacion(id_post){
          fetch('includes/publicaciones.php', {
               method: "POST",
               body: id_post
          }).then((response) => {
               return response.json();
          }).then((data) => {
               let html = '';              
               data.forEach(function(element) {
               html += `<post class="row border rounded-3 border-white mb-3 position-center">
                    <div class="col-md-12 mt-2"><h3 class="text-white fw-bold">${ element.titulo }</h3></div>
               <post-info class="info-post mt-2 col-md-12 text-white"><p>${ element.info }</p></post-info>
               <div class="reaction text-white" align="left">
                    <form action="" method="POST">
                         <p class="clasificacion">
                              <input id="radio1${ element.id_post }" type="radio" name="estrellas" value="5">
                              <label for="radio1${ element.id_post }"><i class="fa-solid fa-popcorn"></i></label>
                              <input id="radio2${ element.id_post }" type="radio" name="estrellas" value="4">
                              <label for="radio2${ element.id_post }"><i class="fa-solid fa-popcorn"></i></label>
                              <input id="radio3${ element.id_post }" type="radio" name="estrellas" value="3">
                              <label for="radio3${ element.id_post }"><i class="fa-solid fa-popcorn"></i></label>
                              <input id="radio4${ element.id_post }" type="radio" name="estrellas" value="2">
                              <label for="radio4${ element.id_post }"><i class="fa-solid fa-popcorn"></i></label>
                              <input id="radio5${ element.id_post }" type="radio" name="estrellas" value="1">
                              <label for="radio5${ element.id_post }"><i class="fa-solid fa-popcorn"></i></label>
                         </p>
                    </form>
               </div>
               <post-comment class="col-md-12">
                    <div class="col-md-12">
                         <div class="body-comment mb-2">
                              <p class="text-name-comment text-white mb-2"></p>
                              <p class="text-comment text-white"></p>
                         </div>
                    </div>
                    <form id="formComment${ element.id_post }">
                         <div class="input-group mb-3">
                              <input type="hidden" name="id_user" id="id_user" value="${ element.id_user }">
                              <input type="hidden" name="id_post" id="id_post" value="${ element.id_post }">
                              <textarea type="text" name="comment" id="comment${ element.id_post }" class="form-control h-comment bg-dark text-white" placeholder="Escribir comentario..." ></textarea>
                              <button type="button" class="btn btn-outline-secondary submit-comment text-white" id="enviar" onclick="enviarDatos(${ element.id_post })">
                                   <i class="fa-solid fa-message"></i>
                              </button>
                         </div>
                    </form>
               </post-comment>
               </post>`;});
               document.getElementById("publicaciones").innerHTML = html;
          }).catch(err => console.error(err));
     }
     
     // Enviar datos de comentarios
     function enviarDatos(id_post){
          let formulario = new FormData(document.getElementById("formComment"+id_post));

          fetch('includes/interacciones.php', {
               method: "post",
               body: formulario
          }).then((response) => {
               document.getElementById("comment"+id_post).value = "";
               return response.json;
          }).then((data) => {
               console.log(data);
          }).catch(err => console.error(err));
     }

     // Camabiar pregunta y respuesta
     function newPreguntas(){
          let formP = new FormData(document.getElementById("newPregunta"));

          fetch('includes/users.php', {
               method: "post",
               body: formP
          }).then((response) => {
               document.getElementById("pass-actual").value = "";
               document.getElementById("respuesta").value = "";
               document.getElementById('selectPregunta').options[0].text;
               return response.json();
          }).then((data) => {
               window.alert(data);
          }).catch(err => console.error(err));
     }

     // Cambiar el password
     function newPassword(){
          let form = new FormData(document.getElementById("newPassword"));

          fetch('includes/users.php', {
               method: "post",
               body: form
          }).then((response) => {
               document.getElementById("passActual").value = "";
               document.getElementById("pass").value = "";
               document.getElementById("pass-confirm").value = "";
               return response.json();
          }).then((data) => {
               window.alert(data);
          }).catch(err => console.error(err));
     }

/* ADMINISTRADOR */

     // Eliminar usuarios 
     function userDelete(id_user){
          let user = new FormData(document.getElementById("userDelete"+id_user));

          fetch('includes/administrador.php', {
               method: "post",
               body: user
          }).then((response) => {
          return response.json();
          }).then((data) => {
               obtener_registros();
               console.log(data);
          }).catch(err => console.error(err));
     }

     // Editar post (Formulario)
     function updatePost(id_post){
          let publicacion = new FormData(document.getElementById("updatePost"+id_post));

          fetch('includes/administrador.php', {
               method: "post",
               body: publicacion
          }).then((response) => {
          return response.json();
          }).then((data) => {
               document.getElementById("editarPost").innerHTML = data;
          }).catch(err => console.error(err));
     }

     $(obtener_registros());

     function obtener_registros(name){
          $.ajax({
               url: 'includes/consulta.php',
               type: 'POST',
               dataType: 'html',
               data: { name: name },
          }).done(function(resultado){
               $("#tabla_resultado").html(resultado);
          })
     }
     
     $(document).on('keyup', '#busqueda', function(){
          var valorBusqueda=$(this).val();
          if (valorBusqueda!=""){
               obtener_registros(valorBusqueda);
          } else {
               obtener_registros();
          }
     });
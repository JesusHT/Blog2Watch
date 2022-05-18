/* USUARIO VISITANTE */

     // Cargar publicaciones usuario
     $(cargarPublicacionUser());
     function cargarPublicacionUser(id_post){
          fetch('includes/publicaciones.php', {
               method: "POST",
               body: id_post
          }).then((response) => {
               return response.json();
          }).then((data) => {
               let html = '';
               data.forEach(function(element) {
               html += `<post class="row border rounded-3 border-white mb-3 position-center">
               <div class="col-md-12 mt-2 row">
                    <h3 class="text-white fw-bold">${ element.titulo }</h3>
               </div>
               <post-info class="info-post text-white mt-2 col-md-12"><p>${ element.info }</p></post-info>
               <div class="reactions2 text-white" align="left">
                    <h6 class="clasificacion2">
                         <input id="radio1${ element.id_post }" type="radio" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                         <label for="radio1${ element.id_post }"><i class="fa-solid fa-popcorn"></i></label>
                         <input id="radio2${ element.id_post }" type="radio" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                         <label for="radio2${ element.id_post }"><i class="fa-solid fa-popcorn"></i></label>
                         <input id="radio3${ element.id_post }" type="radio" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                         <label for="radio3${ element.id_post }"><i class="fa-solid fa-popcorn"></i></label>
                         <input id="radio4${ element.id_post }" type="radio" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                         <label for="radio4${ element.id_post }"><i class="fa-solid fa-popcorn"></i></label>
                         <input id="radio5${ element.id_post }" type="radio" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                         <label for="radio5${ element.id_post }"><i class="fa-solid fa-popcorn"></i></label>
                    </h6>
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
                              <textarea type="text" name="comment" id="comment${ element.id_post }" class="form-control h-comment bg-dark text-white" placeholder="Escribir comentario..."></textarea>
                              <button type="button" class="btn btn-outline-secondary submit-comment text-white" id="enviar" onclick="limpiar(${ element.id_post })" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                   <i class="fa-solid fa-message"></i>
                              </button>
                         </div>
                    </form>
               </post-comment>
          </post>`;});
               document.getElementById("publicacionesUser").innerHTML = html;
          }).catch(err => console.error(err));
     }

    function limpiar(id_post){
        document.getElementById("comment"+id_post).value = "";
    }
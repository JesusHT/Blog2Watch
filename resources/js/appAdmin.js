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

        // Enviar datos de comentarios
        function enviarDatos(id_post){
          let form = new FormData(document.getElementById("formComment"+id_post));

          fetch('includes/publicaciones.php', {
               method: "post",
               body: form
          }).then((response) => {
               document.getElementById("comment"+id_post).value = "";
          }).then((data) => {
               /* Funciones */
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

     var tipo = document.querySelector('#tipo');

     tipo.addEventListener("change", function(){
          var selectipo = this.options[tipo.selectedIndex];
         if (selectipo.value == 1) {
               document.querySelector("#pelicula").style.display="none";
               document.querySelector("#serie").style.display="block";
               //console.log("serie");
         }else if(selectipo.value == 2) {
               document.querySelector("#serie").style.display="none";
               document.querySelector("#pelicula").style.display="block";
               //console.log("Pelicula");
         }
     });
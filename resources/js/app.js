/* USUARIO REGISTRADO */
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

     // Enviar datos de Buzon
     function enviarDatosBuzon(){
          let buzon = new FormData(document.getElementById("enviarDatosBuzon"));
          fetch('includes/users.php',{
               method: "post",
               body: buzon
          }).then((response) =>{
               document.getElementById('enviarDatosBuzon').reset();
               return response.json(); 
          }).then((data) =>{
               document.getElementById("Respuesta").innerHTML = data;
          }).catch(err => console.error(err));
     }
     
     document.getElementById("cerrar_buzon").addEventListener("click",function(){
          document.getElementById("Respuesta").innerHTML = "";
          document.getElementById("closed").style.display="block";
          document.getElementById("open").style.display="none";
     })

     document.querySelector("#mostrar").addEventListener("click", function(){
          document.getElementById("closed").style.display="none";
           document.getElementById("open").style.display="block";
      });
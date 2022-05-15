// Enviar datos de comentarios
function enviarDatos(id_post){
	let formulario = new FormData(document.getElementById("formComment"+id_post));

     fetch('includes/interacciones.php', {
          method: "post",
          body: formulario
     }).then((response) => {
          document.getElementById("comment"+id_post).value = "";
     }).then((data) => {
          /*mas acciones a realizar*/
     })
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
     })
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
     })
}
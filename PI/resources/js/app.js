function enviarDatos(id_post){
	let formulario = new FormData(document.getElementById("formComment"+id_post));

fetch('../PI/includes/interacciones.php', {
     method: "post",
     body: formulario
}).then((response) => {
     document.getElementById("comment"+id_post).value = "";
}).then((data) => {
     /*mas acciones a realizar*/
})
}
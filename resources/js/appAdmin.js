// Insertar publicaciones
function crearPost(){
    let datos = new FormData(document.getElementById("crearPost"));

    fetch('includes/funciones.php', {
        method: "post",
        body: datos
   }).then((response) => {
        document.getElementById("crearPost").reset();
        return response.json();
   }).then((data) => {
       document.getElementById("respustaCrear").innerHTML = data
       mostrarPost();
   }).catch(err => console.error(err));
}

$(mostrarPost());

function mostrarPost(){
    let datos = true;

    fetch('includes/administrador.php', {
        method: "post",
        body: datos
   }).then((response) => {
        return response.json();
   }).then((data) => {
       document.getElementById("accordionPublications").innerHTML = data;
   }).catch(err => console.error(err));
}

// Eliminar Post 
function deletePost(eliminar){
    let datos = new FormData(document.getElementById("formDelete"+eliminar));

    fetch('includes/funciones.php', {
        method: "post",
        body: datos
   }).then((response) => {
        return response.json();
   }).then((data) => {
       mostrarPost();
   }).catch(err => console.error(err));
}

 // Editar post (Formulario)
function updatePost(id_post){
    let publicacion = new FormData(document.getElementById("updatePost"+id_post));

    fetch('includes/editPost.php', {
         method: "post",
         body: publicacion
    }).then((response) => {
        return response.json();
    }).then((data) => {
         document.getElementById("editarPost").innerHTML = data;
    }).catch(err => console.error(err));
}

// Actualizar post
function postUpdate(editar){
    let datos = new FormData(document.getElementById("formUpdate"));

    fetch('includes/funciones.php', {
         method: "post",
         body: datos
    }).then((response) => {
        return response.json();
    }).then((data) => {
        document.getElementById("respuetaUpdate").innerHTML = data;
        mostrarPost();
    }).catch(err => console.error(err));
}

// Mostrar duracion
var tipo = document.querySelector('#tipo');

tipo.addEventListener("change", function(){
    let selectipo = this.options[tipo.selectedIndex];
    if (selectipo.value == 1) {
        document.querySelector("#pelicula").style.display="none";
        document.querySelector("#serie").style.display="block";
    }else if(selectipo.value == 2) {
        document.querySelector("#serie").style.display="none";
        document.querySelector("#pelicula").style.display="block";  
    }
});

// Usuarios 

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

// Eliminar usuarios 
function userDelete(id_user){
    let user = new FormData(document.getElementById("userDelete"+id_user));

    fetch('includes/consulta.php', {
            method: "post",
            body: user
    }).then((response) => {
    return response.json();
    }).then((data) => {
            obtener_registros();
            console.log(data);
    }).catch(err => console.error(err));
}

// Enviar comentarios
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

function recuperar(){
    let data = new FormData(document.getElementById("formRecuperar"));

    fetch('includes/users.php', {
         method: "post",
         body: data
    }).then((response) => {
         return response.json();
    }).then((data) => {
        if (data == false) {
            document.getElementById("noexiste").innerHTML = '<p class="bg-red fw-bold text-white p-1">El usuario no existe. <a href="sign_up.php">Regístrate</a></p>';
        } else {
            document.getElementById("noexiste").innerHTML = '';
            document.querySelector("#enviar").style.display="none";
            document.getElementById('floatingInputUser').readOnly = true;
            document.getElementById("resultado").innerHTML = data;
        }
       
    }).catch(err => console.error(err));
}

function validar(){
    let data = new FormData(document.getElementById("formValidar"));

    fetch('includes/users.php', {
         method: "post",
         body: data
    }).then((response) => {
         return response.json();
    }).then((data) => {
        console.log(data);
        if (data == false) {
            window.alert("Ah ocurrido un error, asegurese de que haya ingresado los datos correctamente");
        } else {
            document.getElementById("formValidar").reset();
            document.getElementById("noexiste").innerHTML = '<p class="bg-green fw-bold text-white p-1">¡Se ha enviado a tu correo tu nueva contraseña!</p>';
        }
    });
}
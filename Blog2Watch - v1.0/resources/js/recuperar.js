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
            document.getElementById("noexiste").innerHTML = '<p class="bg-red fw-bold text-white p-1">¡Ah ocurrido un error, asegurese de haber ingresado los datos correctos!</p>';
        } else {
            let html = `<div class="modal fade show" id="exampleModalLive" tabindex="-1" aria-labelledby="exampleModalLiveLabel" style="display: block;" aria-modal="true" role="dialog">
                            <div class="modal-dialog">
                            <div class="modal-content bg-gray text-white p-2">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLiveLabel">Nueva Contraseña</h5>
                                    <button type="button" onclick="cerrarModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body bg-darkGray">
                                    <p>Hola, ` + data[0] + `</p>
                                    <p class="txt-justify">Queremos que sigas disfrutando de nuestro contenido, así que hemos generado una contraseña temporal que podrás cambiar en cualquier momento en el apartado de "Perfil" de nuestro Blog.  </p>
                                    <p><b>Nueva contraseña:</b> <span class="pass"> ` + data[1] + `</span></p>
                                    <p class="txt-justify"><b>Aviso Importante:</b> Este este mensaje y/o el material adjunto es para uso exclusivo de la persona a la que expresamente se le ha enviado, el cual contiene información confidencial. Se hace de su conocimiento por medio de esta nota, que cualquier divulgación, copia, distribución o toma de cualquier acción derivada de la información confiada en esta transmisión, queda estrictamente prohibido. </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn button-submit text-white mb-3" onclick="location.href='login.php'">Iniciar Sesión</button>
                                </div>
                            </div>
                            </div>
                        </div>`;
            document.getElementById("formValidar").reset();
            document.getElementById("modal").innerHTML = html;
        }
    });
}

function cerrarModal(){
    document.getElementById("exampleModalLive").style.display = "none";
}
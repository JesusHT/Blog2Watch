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
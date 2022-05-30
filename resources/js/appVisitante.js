function limpiar(id_post){document.getElementById("comment"+id_post).value = "";}

// Filtros 
$(filtros());

function filtros(){
    let datos = new FormData(document.getElementById("plataformas"));
    let datos2 = new FormData(document.getElementById("filtros"));

    for (let [key, value] of datos2.entries()) {
        datos.append(key, value);
    }

    fetch('includes/publicaciones.php',{
        method: "post",
        body: datos
   }).then((response) => {
        return response.json(); 
   }).then((data) => {
        document.getElementById("post").innerHTML = data;
   }).catch(err => console.error(err));
}

function reset(){
     document.getElementById("plataformas").reset();
     document.getElementById("filtros").reset();
     
     filtros();
}

document.getElementById("submit").addEventListener("click",function(){
     document.querySelector("#reset").style.display="block";  
});
document.getElementById("reset").addEventListener("click",function(){
     document.querySelector("#reset").style.display="none";  
});
$(obtener_registros());

function obtener_registros(name){
	$.ajax({
		url: '../PI/includes/consulta.php',
		type: 'POST',
		dataType: 'html',
		data: { name: name },
	})

	.done(function(resultado){
		$("#tabla_resultado").html(resultado);
	})
}

$(document).on('keyup', '#busqueda', function(){
	var valorBusqueda=$(this).val();
	if (valorBusqueda!=""){
		obtener_registros(valorBusqueda);
	}
	else{
			obtener_registros();
		}
});

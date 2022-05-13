$('#enviar').click(regresar);

function regresar(){
	$.ajax({
		url: '../PI/includes/interacciones.php',
		type: 'POST',
		dataType: 'html',
		data:{
			comment:$('#comment').val(),
			id_post:$('#id_user').val(),
			id_user:$('#id_post').val()
		}
	}).done({});
}
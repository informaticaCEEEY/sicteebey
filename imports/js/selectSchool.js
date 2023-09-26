$(function(){
	$("#_town").change(function(){		
	var url = "../imports/php/auxiliarFunctions/schoolTown.php"; // El script a donde se realizara la peticion.	
	//$('#saveSuccess').html('<div id="loading"><img src="../img/loading_spinner.gif"/></div>');
	$.ajax({
		type: "POST",
		url: url,
		data: $("#entry").serialize(), // Adjuntar los campos del formulario enviado.
		success: function(data){
			$("#schoolTown").html(data); // Mostrar la respuestas del script PHP.
		}
	});

	 return false; // Evitar ejecutar el submit del formulario.
	 });
});
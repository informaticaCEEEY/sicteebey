$(function(){
	$("#_schoolLevel").change(function(){		
	var url = "../imports/php/auxiliarFunctions/schoolLevelRegion.php"; // El script a donde se realizara la peticion.	
	//$('#saveSuccess').html('<div id="loading"><img src="../img/loading_spinner.gif"/></div>');
	$.ajax({
		type: "POST",
		url: url,
		data: $("#entry").serialize(), // Adjuntar los campos del formulario enviado.
		success: function(data){
			$("#schoolRegion1").html(data); // Mostrar la respuestas del script PHP.
		}
	});

	 return false; // Evitar ejecutar el submit del formulario.
	 });
});

function schoolMode(){
	var url = "../imports/php/auxiliarFunctions/schoolRegionMode.php"; // El script a donde se realizara la peticion.	
	//$('#saveSuccess').html('<div id="loading"><img src="../img/loading_spinner.gif"/></div>');
	$.ajax({
		type: "POST",
		url: url,
		data: $("#entry").serialize(), // Adjuntar los campos del formulario enviado.
		success: function(data){
			$("#schoolMode1").html(data); // Mostrar la respuestas del script PHP.
		}
	});

	 return false; // Evitar ejecutar el submit del formulario.
};
$(function(){
	$("#_schoolRegion").change(function(){	
		alert(1);
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
	 });
});
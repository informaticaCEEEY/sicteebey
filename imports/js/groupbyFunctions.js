$(document).ready(function(){

	if($("#_year").val() != ''){
		$("#_groupby").attr("disabled",true);
		$("#_groupby").find('option:first').attr("selected","selected");		
	}

	if($("#_year").val() != ''){
		$('#_groupby').find('option').not(':first').remove();
		$("#_groupby").find('option:first').attr("selected","selected");
		groupbyPeriod();
	}

	$("#_year").change(function(){
		$("#_groupby").attr("disabled",true);
		$('#_groupby').find('option').not(':first').remove();
		$("#_groupby").find('option:first').attr("selected","selected");
		groupbyPeriod();
	});
});


function groupbyPeriod(){
	var url = "../imports/php/auxiliarFunctions/groupbyPeriod.php"; // El script a donde se realizara la peticion.
	//$('#saveSuccess').html('<div id="loading"><img src="../img/loading_spinner.gif"/></div>');
	$.ajax({
		type: "POST",
		url: url,
		data: $("#entry").serialize(), // Adjuntar los campos del formulario enviado.
		success: function(data){
			$("#_groupby").attr("disabled",false);
			$("#_groupby").append(data); // Mostrar la respuestas del script PHP.
		}
	});

	 return false; // Evitar ejecutar el submit del formulario.
}

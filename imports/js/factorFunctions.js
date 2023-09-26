$(document).ready(function(){

	$("#_schoolLevel").change(function(){
		if($("#_schoolLevel").val() == '0'){
			$("#_schoolMode").attr("disabled",true);
			$("#_schoolZone").attr("disabled",true);
		}else{
			$('#_schoolZone').find('option').not(':first').remove();
			$("#_schoolZone").find('option:first').attr("selected",true);
			$('#_schoolMode').find('option').not(':first').remove();
			$("#_schoolMode").find('option:first').attr("selected",true);
			schoolMode();
		}
	});

	$("#_schoolMode").change(function(){
		$('#_schoolZone').find('option').not(':first').remove();
		//$("#_schoolMode").find('option:first').attr("selected","selected");
		schoolZone();
	});
});

function schoolMode(){
	var url = "../imports/php/auxiliarFunctions/schoolRegionModeContext.php"; // El script a donde se realizara la peticion.
	//$('#saveSuccess').html('<div id="loading"><img src="../img/loading_spinner.gif"/></div>');
	$.ajax({
		type: "POST",
		url: url,
		data: $("#entry").serialize(), // Adjuntar los campos del formulario enviado.
		success: function(data){
			$("#_schoolMode").attr("disabled",false);
			$("#_schoolMode").append(data); // Mostrar la respuestas del script PHP.
		}
	});

	 return false; // Evitar ejecutar el submit del formulario.
};

function schoolZone(){
	var url = "../imports/php/auxiliarFunctions/schoolModeZoneCohorte.php"; // El script a donde se realizara la peticion.
	//$('#saveSuccess').html('<div id="loading"><img src="../img/loading_spinner.gif"/></div>');
	$.ajax({
		type: "POST",
		url: url,
		data: $("#entry").serialize(), // Adjuntar los campos del formulario enviado.
		success: function(data){
			$("#_schoolZone").attr("disabled",false);
			$("#_schoolZone").append(data); // Mostrar la respuestas del script PHP.
		}
	});

	 return false; // Evitar ejecutar el submit del formulario.
};

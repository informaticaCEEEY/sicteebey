$(document).ready(function(){

	$("#userN").css("display", "none");
	$("#school").css("display", "none");
	$("#schoolM").css("display", "none");
	$("#schoolZ").css("display", "none");
	$("#schoolG").css("display", "none");

	if($("#_userType").val() == '2'){
		$("#userN").css("display", "block");
	}else if($("#_userType").val() == '4'){
		$("#school").css("display", "block");
	}else if($("#_userType").val() == '6'){
		$("#school").css("display", "block");
		$("#schoolG").css("display", "block");
	}else if($("#_userType").val() == '5'){
		$("#schoolM").css("display", "block");
		$("#schoolZ").css("display", "block");
	}else{
		$("#userN").css("display", "none");
		$("#school").css("display", "none");
		$("#schoolM").css("display", "none");
		$("#schoolZ").css("display", "none");
		$("#schoolG").css("display", "none");
		$("#_cct").val('');
	}



	$("#_userType").change(function(){

		$("#_schoolZone").attr("disabled",true);
		$('#_schoolZone').find('option').not(':first').remove();

		if($("#_userType").val() == '2'){
			$("#_cct").val('');
			$("#userN").css("display", "block");
			$("#school").css("display", "none");
			$("#schoolM").css("display", "none");
			$("#schoolZ").css("display", "none");
			$("#schoolG").css("display", "none");
			$("#_schoolMode").attr("disabled",true);
			$("#_schoolGrade").attr("disabled",true);
			$("#_schoolGroup").attr("disabled",true);
		}else if($("#_userType").val() == '4'){
			$("#_cct").val('');
			$("#userN").css("display", "none");
			$("#school").css("display", "block");
			$("#schoolM").css("display", "none");
			$("#schoolZ").css("display", "none");
			$("#schoolG").css("display", "none");
			$("#_schoolMode").attr("disabled",true);
			$("#_schoolGrade").attr("disabled",true);
			$("#_schoolGroup").attr("disabled",true);
		}else if($("#_userType").val() == '6'){
			$("#_cct").val('');
			$("#userN").css("display", "none");
			$("#school").css("display", "block");
			$("#schoolM").css("display", "none");
			$("#schoolZ").css("display", "none");
			$("#_schoolMode").attr("disabled",true);
			$("#_schoolGrade").attr("disabled",false);
			$("#_schoolGroup").attr("disabled",false);
			$("#schoolG").css("display", "block");
		}else if($("#_userType").val() == '5'){
			$("#_cct").val('');
			$("#userN").css("display", "none");
			$("#school").css("display", "none");
			$("#schoolM").css("display", "block");
			$("#schoolZ").css("display", "block");
			$("#schoolG").css("display", "none");
			$("#_schoolGrade").attr("disabled",true);
			$("#_schoolGroup").attr("disabled",true);
			$("#_schoolMode").attr("disabled",false);
		}else{
			$("#userN").css("display", "none");
			$("#school").css("display", "none");
			$("#schoolM").css("display", "none");
			$("#schoolZ").css("display", "none");
			$("#schoolG").css("display", "none");
			$("#_cct").val('');
			$("#_schoolMode").attr("disabled",true);
			$("#_schoolGrade").attr("disabled",true);
			$("#_schoolGroup").attr("disabled",true);
		}
	});

	$("#_schoolMode").change(function(){
		$('#_schoolZone').find('option').not(':first').remove();
		$("#_schoolZone").find('option:first').attr("selected","selected");
		schoolZone();
	});

	 return false; // Evitar ejecutar el submit del formulario.
});


function schoolZone(){
	var url = "../imports/php/auxiliarFunctions/schoolZone.php"; // El script a donde se realizara la peticion.
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

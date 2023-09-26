$(document).ready(function() {
	jQuery.validator.setDefaults({
		errorClass : 'formError'
	});
	$('#entry img[title]').tooltip();
	$('#entry').validate({
		rules : {
			'id' : {
				required : true,
				number : true
			},
			'lastName' : {
				required : true
			},
			'secondName' : {
				required : true
			},
			'name' : {
				required : true
			},
			'curp' : {
				required : true
			},
			'gender' : {
				required : true
			},
			'birthDate' : {
				required : true
			},
		}
	});
});
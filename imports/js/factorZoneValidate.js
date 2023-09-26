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
			'zone' : {
				required : true,
				number : true
			},
			'factor' : {
				required : true,
				number : true
			},
			'media' : {
				required : true,
				number : true
			},
			'factorCount' : {
				required : true,
				number : true
			},
		}
	});
});
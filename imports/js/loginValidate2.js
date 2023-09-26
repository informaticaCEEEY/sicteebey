$(document).ready(function() {
	
	jQuery.validator.setDefaults({
		errorClass : 'formError'
		});
		
		$('#entry img[title]').tooltip(); 
		
		$('#entry').validate({
			rules : {
				'email':{
					required:true					
				},
				'password':{
					required:true,
					minlength: 8
				},
			},
			messages : {
				'email':{
					required:'Ingrese un correo electrónico'					
				},
				'password':{
					required:'Ingrese su contraseña',
					minlength: 'Ingrese una contraseña del al menos 8 caracteres'
				},
			}
		});
	});
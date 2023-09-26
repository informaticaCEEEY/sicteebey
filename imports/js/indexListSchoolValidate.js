$(function () {
	
	if($(window).width() > 824){
		$('[data-toggle="tooltip"]').tooltip({placement : 'left'})
	}else{
		$('[data-toggle="tooltip"]').tooltip({placement : 'top'})
	}
	 
})

$("#entry").validate({
    errorClass: "formError",    
    highlight: function (element, errorClass) {
    },
    rules: {
        'indexList': {
            required: true
        },
        'cct': {
            required: true,
            rangelength: [10,10]
        },
        'schoolGroup': {
            required: true
        },
    },
    messages: {
    	'indexList': {
            required: 'Seleccione una opci\u00F3n'
        }, 
        'cct': {
            required: 'Ingrese su CCT.',
            rangelength: 'Ingrese los 10 caracteres de la Clave del Centro de Trabajo.'
        },  
        'schoolGroup': {
            required: 'Seleccione una opci\u00F3n'
        },
    }
});

var $loading = $('#loading').hide();

$(function(){
	$('form').submit(function(e) {
		if($(this).valid()){
			$loading.show();
		}
		//$('body').plainOverlay('show');		
	 });
});
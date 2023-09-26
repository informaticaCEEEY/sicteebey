$.validate({
});

$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})

$("#entry").validate({
    errorClass: "formError",    
    highlight: function (element, errorClass) {
        //alert('em');
        //$(element).fadeOut(100,function () {
            //$(element).fadeIn(100);
       // });
    },
    rules: {
        'cohorte': {
            required: true
        },
        'cct': {
            required: true
        },
    },
    messages: {
    	'cohorte': {
            required: 'Seleccione una opci\u00F3n'
        },    
        'cct': {
            required: 'Ingrese la Clave del Centro de Trabajo'
        }, 
    }
});

/*var $loading = $('#loading').hide();

$(function(){
	$('form').submit(function(e) {
		if($(this).valid()){
			$loading.show();
		}
		//$('body').plainOverlay('show');		
	 });
});*/
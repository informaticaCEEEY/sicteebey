$(function () {
	
	if($(window).width() > 824){
		$('[data-toggle="tooltip"]').tooltip({placement : 'left'})
	}else{
		$('[data-toggle="tooltip"]').tooltip({placement : 'top'})
	}
	 
})

$("#entry").validate({
	errorClass : "formError",
	highlight : function(element, errorClass) {
	},
	rules : {
		'factor' : {
			required : true
		},
	},
	messages : {
		'factor' : {
			required : 'Seleccione una opci\u00F3n'
		},
	}
});

var $loading = $('#loading').hide();

$(function() {
	$('form').submit(function(e) {
		if ($(this).valid()) {
			$loading.show();
		}
		//$('body').plainOverlay('show');		
	});
});
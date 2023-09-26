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
        'level': {
            required: true
        },
        'schoolRegion': {
            required: true
        },
        'mode': {
            required: true
        },
        'zone': {
            required: true
        },
    },
    messages: {
        'level': {
        	 required: 'Seleccione un nivel'
        },
        'schoolRegion': {
        	 required: 'Seleccione una regi\u00F3n'
        },
        'mode': {
        	 required: 'Seleccione una modalidad'
        },
        'zone': {
        	 required: 'Seleccione una zona'
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

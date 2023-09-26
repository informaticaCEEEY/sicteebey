$.validate({
	modules : 'file, sanitize'
});

$('#_summary').restrictLength( $('#max-length-element') );

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
/*$(document).ready(function () {
    $('#entry').validate({
        rules: {
            'content': {
                required: true
            }
        },
        messages: {            
        	'content': {
                required: 'sas'
            }
        },
        errorPlacement: function(error, $elem) {
            if ($elem.is('textarea')) {
                $elem.next().css('border', '1px solid rgb(185, 74, 72)');
            }
        },
        ignore: []
    });
});*/
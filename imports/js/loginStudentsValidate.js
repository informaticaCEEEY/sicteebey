$(function () {

	if($(window).width() > 824){
		$('[data-toggle="tooltip"]').tooltip({placement : 'left'})
	}else{
		$('[data-toggle="tooltip"]').tooltip({placement : 'top'})
	}
})

$.validate({
	modules : 'security'
});

$("#entry").validate({
	errorClass: "formError",
	highlight: function (element, errorClass) {
		//alert('em');
		//$(element).fadeOut(100,function () {
		//$(element).fadeIn(100);
		// });
	},
	rules: {
		'folioStudent': {
			required: true,
			rangelength: [6, 6]
		}
	},
	messages: {
		'folioStudent': {
			required: 'Ingrese su folio IDAEPY',
			rangelength: 'El folio se encuentra conformado por 6 dígitos'
		}
	}
});

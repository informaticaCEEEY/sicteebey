$("#entry2").validate({
    errorClass: "formError",    
    highlight: function (element, errorClass) {
    },
    rules: {
        'factor': {
            required: true
        },
        'cct': {
            required: true
        },
    },
    messages: {
    	'factor': {
            required: 'Seleccione una opci\u00F3n'
        }, 
        'cct': {
            required: 'Ingrese su CCT'
        },  
    }
});
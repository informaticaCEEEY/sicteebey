$(document).ready(function() {jQuery.validator.setDefaults({errorClass : 'formError'});$('#entry img[title]').tooltip(); $('#entry').validate({rules : {'id':{required:true},'schoolPeriod':{required:true},'cohorte':{required:true},'grade':{required:true},'schoolLevel':{required:true},}});});
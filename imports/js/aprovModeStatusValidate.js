$(document).ready(function() {jQuery.validator.setDefaults({errorClass : 'formError'});$('#entry img[title]').tooltip(); $('#entry').validate({rules : {'id':{required:true,number:true},'cohorte':{required:true,number:true},'schoolPeriod':{required:true,number:true},'mode':{required:true,number:true},'statusA':{required:true,number:true},'statusR':{required:true,number:true},'statusX':{required:true,number:true},'statusZ':{required:true,number:true},'unregisteredThree':{required:true,number:true},}});});
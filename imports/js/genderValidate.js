$(document).ready(function() {jQuery.validator.setDefaults({errorClass : 'formError'});$('#entry img[title]').tooltip(); $('#entry').validate({rules : {'id':{required:true},'name':{required:true},}});});
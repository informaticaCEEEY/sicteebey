$(document).ready(function() {jQuery.validator.setDefaults({errorClass : 'formError'});$('#entry img[title]').tooltip(); $('#entry').validate({rules : {'id':{required:true,number:true},'cct':{required:true,number:true},'schedule':{required:true,number:true},'grade':{required:true,number:true},'schoolGroup':{required:true,number:true},'factor':{required:true,number:true},'media':{required:true,number:true},'total':{required:true,number:true},}});});
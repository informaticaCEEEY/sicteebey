$(document).ready(function() {jQuery.validator.setDefaults({errorClass : 'formError'});$('#entry img[title]').tooltip(); $('#entry').validate({rules : {'id':{required:true,number:true},'student':{required:true,number:true},'cct':{required:true,number:true},'IMC':{required:true,number:true},'weight':{required:true,number:true},'height':{required:true,number:true},'gender':{required:true,number:true},'description':{required:true,number:true},}});});
$(document).ready(function() {jQuery.validator.setDefaults({errorClass : 'formError'});$('#entry img[title]').tooltip(); $('#entry').validate({rules : {'id':{required:true,number:true},'idStudent':{required:true,number:true},'startYear':{required:true,number:true},'cct':{required:true,number:true},'grade':{required:true,number:true},'schoolGroup':{required:true,number:true},'status':{required:true,number:true},'finalScore':{required:true,number:true},'idCohorte':{required:true,number:true},'initialCohort':{required:true,number:true},}});});
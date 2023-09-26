add=new Array('add', 'addButton', 'Nuevo Usuario');
edit=new Array('edit', 'editButton', 'Editar Usuario');
password=new Array('password', 'passwordButton', 'Cambiar Contrase\u00F1a');
deleted=new Array('', 'deleteButton', 'Eliminar');
buttons=new Array(add,edit,password);
var oTable;
var aData;
var gaiSelected =  [];
var pop;
var seleccion='';
var menuBar='';

for(i=0; i<3; i++){
    menuBar+='<a id=\"'+buttons[i][0]+'\" name=\"off\" class=\"production\" target=\"\" href=\"'
        + linkAdd
        + '\" rel=\"#overlay\" style=\"text-decoration:none;\">'
        + '<button id=\"'+buttons[i][1]+'\" type=\"button\" class=\"btn btn-primary\">'+buttons[i][2]
        + '</button></a> ';
}
//menuBar+= '<button id=\"'+buttons[3][1]+'\" name=\"\" type=\"button\" class=\"btn btn-danger\">'+buttons[3][2]+''
//    + '</button>';
    
$(document).ready(function() {
    oTable = $('#entity').dataTable({
        "sDom" : '<"toolbar">frtip',
        //"bJQueryUI" : true,
        "sScrollX" : 1140,
        "sScrollXInner" : 1140,
        "bAutoWidth" : true,
        "sPaginationType" : "full_numbers",
        "bProcessing" : true,
        "bServerSide" : true,
        "sAjaxSource" : sourceLink,
        "fnRowCallback" : function(nRow, aData, iDisplayIndex) {

            if(jQuery.inArray(aData[0], gaiSelected) != -1) {
                $(nRow).addClass('row_selected');
            }
            return nRow;
        },
        "aoColumns" : [{"bVisible" : 0}, null, null, null, null, null, null],
        "oLanguage" : {
        	"sLoadingRecords" : "Cargando...",
        	"sProcessing" : "Cargando...",
        	"sLengthMenu" : "Mostrar _MENU_ entradas por pagina",
            "sZeroRecords" : "No Existen Datos",
            "sInfo" : "Mostrados _START_ a _END_ de _TOTAL_ Entradas",
            "sInfoFiltered" : "(de un total de _MAX_ Entradas)",
            "sInfoEmpty" : "Mostrados 0 a 0 de 0 Entradas",
        	"sSearch" : "Buscar",
            "oPaginate" : {
                "sFirst" : "Primero",
                "sPrevious" : "Anterior",
                "sNext" : "Siguiente",
                "sLast" : "Ultimo"
            }
        }
    });
    
    /* Click event handler */
    $('#entity tbody').on('click', 'tr', function() {    	
        aData = oTable.fnGetData(this);
        var iId = aData[0];
        //alert(iId);
        $(oTable.fnSettings().aoData).each(function() {
            $(this.nTr).removeClass('bg-info');
            seleccionado = true;
        });
        //$(this).addClass('row_selected');
        $(this).addClass('bg-info');
        seleccion='selected';
        newHtml = '<p>&iquest;Realmente desea Eliminar la entrada?</p><p>';
        newHtml += '<button class=\"btn btn-danger btn-md\" onclick=\"deleteData()\"> S&iacute; </button>';
        newHtml += ' <button onclick=\"pop.close()\" class=\"btn btn-primary btn-md\"> No </button></p>';
        $('#edit').attr('href', linkEdit+iId);
        $('#password').attr('href', linkPassword+iId);
        $('#deleteButton').attr('name',iId);
        $('#tesd').html(newHtml);
    });
    
    $("#entity_wrapper div.toolbar").html(menuBar);
    
    //pop = $('#myModal').modal('show');
    
    //$('#addButton').click(function() {
        
      //  $('#add').attr('name', 'on');
    //});
    
    $('#deleteButton').click(function() {
    	$('#myModal').modal('show');
    });
    
    $('#edit').attr('href', '');    
            
    $('#editButton').click(function() {     	    	
    	
    	if($('#edit').attr('href')==''){
    		
    		$('#myModal').modal('show');
    		return false;
    	}
    });
    
    $('#password').attr('href', '');
    
    $('#passwordButton').click(function() {     	    	
    	
    	if($('#password').attr('href')==''){
    		
    		$('#myModal').modal('show');
    		return false;
    	}
    });
});

function deleteData(){
    
	$('#deleteForm').attr('action', linkDelete+$('#deleteButton').attr('name'));
    $('#form_id').val($('#deleteButton').attr('name'));
    $('#action').val('delete');
    $('#deleteForm').submit();
}

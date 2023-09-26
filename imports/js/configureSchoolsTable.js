add=new Array('add', 'addButton', 'Nueva Escuela');
edit=new Array('edit', 'editButton', 'Editar Escuela');
editZone=new Array('editZone', 'editZoneButton', 'Cambiar Zona');
deleted=new Array('', 'deleteButton', 'Eliminar');
buttons=new Array(edit, editZone);
var oTable;
var aData;
var gaiSelected =  [];
var pop;
var seleccion='';
var menuBar='';

for(i=0; i<2; i++){
    menuBar+='<a id=\"'+buttons[i][0]+'\" name=\"off\" class=\"production\" target=\"\" href=\"'
        + linkAdd
        + '\" rel=\"#overlay\" style=\"text-decoration:none;\">'
        + '<button id=\"'+buttons[i][1]+'\" type=\"button\" class=\"btn btn-primary\">'+buttons[i][2]
        + '</button></a> ';
}
//menuBar+= '<button id=\"'+buttons[2][1]+'\" name=\"\" type=\"button\" class=\"btn btn-danger\">'+buttons[2][2]+''
//    + '</button>';

$(document).ready(function() {
    oTable = $('#entity').dataTable({
        "dom" : '<"toolbar">frtip',
        //"bJQueryUI" : true,
        "scrollX" : 1140,
        "scrollXInner" : 1140,
        "autoWidth" : true,
        "paginationType" : "full_numbers",
        "processing" : true,
        "serverSide" : true,
        "ajaxSource" : sourceLink,
        "fnRowCallback" : function(nRow, aData, iDisplayIndex) {

            if(jQuery.inArray(aData[0], gaiSelected) != -1) {
                $(nRow).addClass('row_selected');
            }
            return nRow;
        },
        "columns" : [{"bVisible" : 0}, null, null, null, null, null, null, null],
        "language" : {
        	"loadingRecords" : "Cargando...",
        	"processing" : "Cargando...",
        	"lengthMenu" : "Mostrar _MENU_ entradas por pagina",
            "zeroRecords" : "No Existen Datos",
            "info" : "Mostrados _START_ a _END_ de _TOTAL_ Entradas",
            "infoFiltered" : "(de un total de _MAX_ Entradas)",
            "infoEmpty" : "Mostrados 0 a 0 de 0 Entradas",
        	"search" : "Buscar",
            "paginate" : {
                "first" : "Primero",
                "previous" : "Anterior",
                "next" : "Siguiente",
                "last" : "Ultimo"
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
        $('#editZone').attr('href', linkZone+iId);
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

    $('#editZone').attr('href', '');

    $('#editButton').click(function() {

    	if($('#edit').attr('href')==''){

    		$('#myModal').modal('show');
    		return false;
    	}
    });

    $('#editZoneButton').click(function() {

    	if($('#editZone').attr('href')==''){

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

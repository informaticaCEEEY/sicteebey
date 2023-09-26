<?php
class PreescolarForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('IdAlumno','idAlumno', '','');
		$this -> entryText('Nombre','nombre', '','');
		$this -> entryText('ApellidoPaterno','apellidoPaterno', '','');
		$this -> entryText('AMaterno','aMaterno', '','');
		$this -> entryText('Ciclo','ciclo', '','');
		$this -> entryText('Curp','curp', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('Escuela','escuela', '','');
		$this -> entryText('Grado','grado', '','');
		$this -> entryText('Grupo','grupo', '','');
		$this -> entryText('Turno','turno', '','');
		$this -> entryText('Nivel','nivel', '','');
		$this -> entryText('Modalidad','modalidad', '','');
		$this -> entryText('Sector','sector', '','');
		$this -> entryText('Zona','zona', '','');
		$this -> entryText('Estatus','estatus', '','');
		echo("</table>");
	}

	public function editForm(Preescolar $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('IdAlumno','idAlumno', '','');
		$this -> entryText('Nombre','nombre', '','');
		$this -> entryText('ApellidoPaterno','apellidoPaterno', '','');
		$this -> entryText('AMaterno','aMaterno', '','');
		$this -> entryText('Ciclo','ciclo', '','');
		$this -> entryText('Curp','curp', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('Escuela','escuela', '','');
		$this -> entryText('Grado','grado', '','');
		$this -> entryText('Grupo','grupo', '','');
		$this -> entryText('Turno','turno', '','');
		$this -> entryText('Nivel','nivel', '','');
		$this -> entryText('Modalidad','modalidad', '','');
		$this -> entryText('Sector','sector', '','');
		$this -> entryText('Zona','zona', '','');
		$this -> entryText('Estatus','estatus', '','');
		echo("</table>");
	}

}
?>
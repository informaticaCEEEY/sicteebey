<?php
class FactorClassroomForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('Schedule','schedule', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('GroupSchool','groupSchool', '','');
		$this -> entryText('Factor','factor', '','');
		$this -> entryText('Media','media', '','');
		$this -> entryText('Total','total', '','');
		echo("</table>");
	}

	public function editForm(FactorClassroom $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('Schedule','schedule', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('GroupSchool','groupSchool', '','');
		$this -> entryText('Factor','factor', '','');
		$this -> entryText('Media','media', '','');
		$this -> entryText('Total','total', '','');
		echo("</table>");
	}

}
?>
<?php
class FactorClassroom2Form extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('Schedule','schedule', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('SchoolGroup','schoolGroup', '','');
		$this -> entryText('Factor','factor', '','');
		$this -> entryText('Media','media', '','');
		$this -> entryText('Total','total', '','');
		echo("</table>");
	}

	public function editForm(FactorClassroom2 $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('Schedule','schedule', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('SchoolGroup','schoolGroup', '','');
		$this -> entryText('Factor','factor', '','');
		$this -> entryText('Media','media', '','');
		$this -> entryText('Total','total', '','');
		echo("</table>");
	}

}
?>
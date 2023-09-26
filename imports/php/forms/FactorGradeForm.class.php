<?php
class FactorGradeForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Factor','factor', '','');
		$this -> entryText('Grade','grade', '','');
		echo("</table>");
	}

	public function editForm(FactorGrade $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Factor','factor', '','');
		$this -> entryText('Grade','grade', '','');
		echo("</table>");
	}

}
?>
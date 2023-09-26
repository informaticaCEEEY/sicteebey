<?php
class QuestionGradeForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Question','question', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('Enabled','enabled', '','');
		echo("</table>");
	}

	public function editForm(QuestionGrade $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Question','question', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('Enabled','enabled', '','');
		echo("</table>");
	}

}
?>
<?php
class FactorQuestionsForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Factor','factor', '','');
		$this -> entryText('Question','question', '','');
		$this -> entryText('QuestionNumber','questionNumber', '','');
		echo("</table>");
	}

	public function editForm(FactorQuestions $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Factor','factor', '','');
		$this -> entryText('Question','question', '','');
		$this -> entryText('QuestionNumber','questionNumber', '','');
		echo("</table>");
	}

}
?>
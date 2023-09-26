<?php
class QuestionAnswerForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Question','question', '','');
		$this -> entryText('Answer','answer', '','');
		echo("</table>");
	}

	public function editForm(QuestionAnswer $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Question','question', '','');
		$this -> entryText('Answer','answer', '','');
		echo("</table>");
	}

}
?>
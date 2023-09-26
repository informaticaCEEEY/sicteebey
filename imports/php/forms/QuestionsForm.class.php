<?php
class QuestionsForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Title','title', '','');
		$this -> entryText('Factor','factor', '','');
		echo("</table>");
	}

	public function editForm(Questions $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Title','title', '','');
		$this -> entryText('Factor','factor', '','');
		echo("</table>");
	}

}
?>
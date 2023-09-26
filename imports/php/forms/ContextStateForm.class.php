<?php
class ContextStateForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Category','category', '','');
		$this -> entryText('Question','question', '','');
		$this -> entryText('Answer','answer', '','');
		$this -> entryText('Total','total', '','');
		echo("</table>");
	}

	public function editForm(ContextState $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Category','category', '','');
		$this -> entryText('Question','question', '','');
		$this -> entryText('Answer','answer', '','');
		$this -> entryText('Total','total', '','');
		echo("</table>");
	}

}
?>
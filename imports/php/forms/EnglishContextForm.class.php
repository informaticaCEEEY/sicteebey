<?php
class EnglishContextForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P14O9','P14O9', '','');
		$this -> entryText('P14O10','P14O10', '','');
		$this -> entryText('P14O11','P14O11', '','');
		echo("</table>");
	}

	public function editForm(EnglishContext $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P14O9','P14O9', '','');
		$this -> entryText('P14O10','P14O10', '','');
		$this -> entryText('P14O11','P14O11', '','');
		echo("</table>");
	}

}
?>
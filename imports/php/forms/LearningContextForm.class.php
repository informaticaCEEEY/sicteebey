<?php
class LearningContextForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P14O1','P14O1', '','');
		$this -> entryText('P14O2','P14O2', '','');
		$this -> entryText('P14O3','P14O3', '','');
		$this -> entryText('P14O4','P14O4', '','');
		$this -> entryText('P14O5','P14O5', '','');
		$this -> entryText('P14O6','P14O6', '','');
		$this -> entryText('P14O7','P14O7', '','');
		$this -> entryText('P14O8','P14O8', '','');
		echo("</table>");
	}

	public function editForm(LearningContext $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P14O1','P14O1', '','');
		$this -> entryText('P14O2','P14O2', '','');
		$this -> entryText('P14O3','P14O3', '','');
		$this -> entryText('P14O4','P14O4', '','');
		$this -> entryText('P14O5','P14O5', '','');
		$this -> entryText('P14O6','P14O6', '','');
		$this -> entryText('P14O7','P14O7', '','');
		$this -> entryText('P14O8','P14O8', '','');
		echo("</table>");
	}

}
?>
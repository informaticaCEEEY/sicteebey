<?php
class ParentSupportContextForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P4O1','P4O1', '','');
		$this -> entryText('P4O2','P4O2', '','');
		$this -> entryText('P4O3','P4O3', '','');
		$this -> entryText('P4O4','P4O4', '','');
		$this -> entryText('P4O5','P4O5', '','');
		$this -> entryText('P4O6','P4O6', '','');
		$this -> entryText('P4O7','P4O7', '','');
		$this -> entryText('P4O8','P4O8', '','');
		echo("</table>");
	}

	public function editForm(ParentSupportContext $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P4O1','P4O1', '','');
		$this -> entryText('P4O2','P4O2', '','');
		$this -> entryText('P4O3','P4O3', '','');
		$this -> entryText('P4O4','P4O4', '','');
		$this -> entryText('P4O5','P4O5', '','');
		$this -> entryText('P4O6','P4O6', '','');
		$this -> entryText('P4O7','P4O7', '','');
		$this -> entryText('P4O8','P4O8', '','');
		echo("</table>");
	}

}
?>
<?php
class StudyTechniquesContextForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P7O1','P7O1', '','');
		$this -> entryText('P7O2','P7O2', '','');
		$this -> entryText('P7O3','P7O3', '','');
		$this -> entryText('P7O5','P7O5', '','');
		$this -> entryText('P7O4','P7O4', '','');
		$this -> entryText('P7O7','P7O7', '','');
		echo("</table>");
	}

	public function editForm(StudyTechniquesContext $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P7O1','P7O1', '','');
		$this -> entryText('P7O2','P7O2', '','');
		$this -> entryText('P7O3','P7O3', '','');
		$this -> entryText('P7O5','P7O5', '','');
		$this -> entryText('P7O4','P7O4', '','');
		$this -> entryText('P7O7','P7O7', '','');
		echo("</table>");
	}

}
?>
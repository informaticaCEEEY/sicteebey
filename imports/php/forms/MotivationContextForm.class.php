<?php
class MotivationContextForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P6O1','P6O1', '','');
		$this -> entryText('P6O2','P6O2', '','');
		$this -> entryText('P6O3','P6O3', '','');
		echo("</table>");
	}

	public function editForm(MotivationContext $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P6O1','P6O1', '','');
		$this -> entryText('P6O2','P6O2', '','');
		$this -> entryText('P6O3','P6O3', '','');
		echo("</table>");
	}

}
?>
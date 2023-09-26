<?php
class AutoeficaciaContextForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P8O1','P8O1', '','');
		$this -> entryText('P8O2','P8O2', '','');
		$this -> entryText('P8O3','P8O3', '','');
		$this -> entryText('P8O4','P8O4', '','');
		$this -> entryText('P8O5','P8O5', '','');
		echo("</table>");
	}

	public function editForm(AutoeficaciaContext $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P8O1','P8O1', '','');
		$this -> entryText('P8O2','P8O2', '','');
		$this -> entryText('P8O3','P8O3', '','');
		$this -> entryText('P8O4','P8O4', '','');
		$this -> entryText('P8O5','P8O5', '','');
		echo("</table>");
	}

}
?>
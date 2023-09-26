<?php
class ContextForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('GroupSchool','groupSchool', '','');
		$this -> entryText('Zone','zone', '','');
		$this -> entryText('Year','year', '','');
		echo("</table>");
	}

	public function editForm(Context $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('GroupSchool','groupSchool', '','');
		$this -> entryText('Zone','zone', '','');
		$this -> entryText('Year','year', '','');
		echo("</table>");
	}

}
?>
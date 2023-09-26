<?php
class ContextScheduleForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('Total','total', '','');
		$this -> entryText('Type','type', '','');
		$this -> entryText('Year','year', '','');
		echo("</table>");
	}

	public function editForm(ContextSchedule $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('Total','total', '','');
		$this -> entryText('Type','type', '','');
		$this -> entryText('Year','year', '','');
		echo("</table>");
	}

}
?>
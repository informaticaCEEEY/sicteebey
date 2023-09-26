<?php
class AprovForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cohorte','cohorte', '','');
		$this -> entryText('SchoolPeriod','schoolPeriod', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('Total','total', '','');
		echo("</table>");
	}

	public function editForm(Aprov $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cohorte','cohorte', '','');
		$this -> entryText('SchoolPeriod','schoolPeriod', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('Total','total', '','');
		echo("</table>");
	}

}
?>
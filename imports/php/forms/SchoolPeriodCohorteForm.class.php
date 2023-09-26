<?php
class SchoolPeriodCohorteForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('SchoolPeriod','schoolPeriod', '','');
		$this -> entryText('Cohorte','cohorte', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('SchoolLevel','schoolLevel', '','');
		echo("</table>");
	}

	public function editForm(SchoolPeriodCohorte $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('SchoolPeriod','schoolPeriod', '','');
		$this -> entryText('Cohorte','cohorte', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('SchoolLevel','schoolLevel', '','');
		echo("</table>");
	}

}
?>
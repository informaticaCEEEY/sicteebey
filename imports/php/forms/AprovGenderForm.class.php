<?php
class AprovGenderForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cohorte','cohorte', '','');
		$this -> entryText('SchoolPeriod','schoolPeriod', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('TotalMen','totalMen', '','');
		$this -> entryText('TotalWomen','totalWomen', '','');
		echo("</table>");
	}

	public function editForm(AprovGender $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cohorte','cohorte', '','');
		$this -> entryText('SchoolPeriod','schoolPeriod', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('TotalMen','totalMen', '','');
		$this -> entryText('TotalWomen','totalWomen', '','');
		echo("</table>");
	}

}
?>
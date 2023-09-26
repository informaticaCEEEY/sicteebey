<?php
class SchoolEnvironmentForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('R3_R3','R3_R3', '','');
		$this -> entryText('R4_R4','R4_R4', '','');
		$this -> entryText('R5_R5','R5_R5', '','');
		$this -> entryText('R6_R6','R6_R6', '','');
		$this -> entryText('R7_R7','R7_R7', '','');
		echo("</table>");
	}

	public function editForm(SchoolEnvironment $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('R3_R3','R3_R3', '','');
		$this -> entryText('R4_R4','R4_R4', '','');
		$this -> entryText('R5_R5','R5_R5', '','');
		$this -> entryText('R6_R6','R6_R6', '','');
		$this -> entryText('R7_R7','R7_R7', '','');
		echo("</table>");
	}

}
?>
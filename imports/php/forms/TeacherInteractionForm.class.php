<?php
class TeacherInteractionForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('R8_R8','R8_R8', '','');
		$this -> entryText('R9_R9','R9_R9', '','');
		$this -> entryText('R10_R12','R10_R12', '','');
		$this -> entryText('R11_R17','R11_R17', '','');
		$this -> entryText('R12_R19','R12_R19', '','');
		echo("</table>");
	}

	public function editForm(TeacherInteraction $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('R8_R8','R8_R8', '','');
		$this -> entryText('R9_R9','R9_R9', '','');
		$this -> entryText('R10_R12','R10_R12', '','');
		$this -> entryText('R11_R17','R11_R17', '','');
		$this -> entryText('R12_R19','R12_R19', '','');
		echo("</table>");
	}

}
?>
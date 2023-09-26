<?php
class StudentsImcForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('IMC','IMC', '','');
		$this -> entryText('Weight','weight', '','');
		$this -> entryText('Height','height', '','');
		$this -> entryText('Gender','gender', '','');
		$this -> entryText('Description','description', '','');
		echo("</table>");
	}

	public function editForm(StudentsImc $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('IMC','IMC', '','');
		$this -> entryText('Weight','weight', '','');
		$this -> entryText('Height','height', '','');
		$this -> entryText('Gender','gender', '','');
		$this -> entryText('Description','description', '','');
		echo("</table>");
	}

}
?>
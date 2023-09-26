<?php
class StudentsForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('LastName','lastName', '','');
		$this -> entryText('SecondName','secondName', '','');
		$this -> entryText('Name','name', '','');
		$this -> entryText('Curp','curp', '','');
		$this -> entryText('Gender','gender', '','');
		$this -> entryText('BirthDate','birthDate', '','');
		echo("</table>");
	}

	public function editForm(Students $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('LastName','lastName', '','');
		$this -> entryText('SecondName','secondName', '','');
		$this -> entryText('Name','name', '','');
		$this -> entryText('Curp','curp', '','');
		$this -> entryText('Gender','gender', '','');
		$this -> entryText('BirthDate','birthDate', '','');
		echo("</table>");
	}

}
?>
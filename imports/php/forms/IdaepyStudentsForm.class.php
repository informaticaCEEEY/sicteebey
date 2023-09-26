<?php
class IdaepyStudentsForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('GroupSchool','groupSchool', '','');
		$this -> entryText('Cct','cct', '','');
		echo("</table>");
	}

	public function editForm(IdaepyStudents $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('GroupSchool','groupSchool', '','');
		$this -> entryText('Cct','cct', '','');
		echo("</table>");
	}

}
?>
<?php
class AprovModeDataForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cohorte','cohorte', '','');
		$this -> entryText('SchoolPeriod','schoolPeriod', '','');
		$this -> entryText('Mode','mode', '','');
		$this -> entryText('Total','total', '','');
		$this -> entryText('NewStudents','newStudents', '','');
		$this -> entryText('StudentsLeaving','studentsLeaving', '','');
		$this -> entryText('TotalIdeal','totalIdeal', '','');
		$this -> entryText('NewStudentsIdeal','newStudentsIdeal', '','');
		$this -> entryText('StudentsIdealLeaving','studentsIdealLeaving', '','');
		$this -> entryText('SlightLag','slightLag', '','');
		$this -> entryText('SeriousLag','seriousLag', '','');
		$this -> entryText('Unregistered','unregistered', '','');
		echo("</table>");
	}

	public function editForm(AprovModeData $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cohorte','cohorte', '','');
		$this -> entryText('SchoolPeriod','schoolPeriod', '','');
		$this -> entryText('Mode','mode', '','');
		$this -> entryText('Total','total', '','');
		$this -> entryText('NewStudents','newStudents', '','');
		$this -> entryText('StudentsLeaving','studentsLeaving', '','');
		$this -> entryText('TotalIdeal','totalIdeal', '','');
		$this -> entryText('NewStudentsIdeal','newStudentsIdeal', '','');
		$this -> entryText('StudentsIdealLeaving','studentsIdealLeaving', '','');
		$this -> entryText('SlightLag','slightLag', '','');
		$this -> entryText('SeriousLag','seriousLag', '','');
		$this -> entryText('Unregistered','unregistered', '','');
		echo("</table>");
	}

}
?>
<?php
class CohorteReportForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Cohorte','cohorte', '','');
		$this -> entryText('TotalStudents','totalStudents', '','');
		$this -> entryText('SchoolPeriod','schoolPeriod', '','');
		$this -> entryText('EnrolledStudents','enrolledStudents', '','');
		$this -> entryText('TotalIdealDegree','totalIdealDegree', '','');
		$this -> entryText('SlightLag','slightLag', '','');
		$this -> entryText('SeriousLag','seriousLag', '','');
		$this -> entryText('Unregistered','unregistered', '','');
		$this -> entryText('UnregisteredThree','unregisteredThree', '','');
		$this -> entryText('Graduates','graduates', '','');
		$this -> entryText('EnrolledNextGrade','enrolledNextGrade', '','');
		echo("</table>");
	}

	public function editForm(CohorteReport $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Cohorte','cohorte', '','');
		$this -> entryText('TotalStudents','totalStudents', '','');
		$this -> entryText('SchoolPeriod','schoolPeriod', '','');
		$this -> entryText('EnrolledStudents','enrolledStudents', '','');
		$this -> entryText('TotalIdealDegree','totalIdealDegree', '','');
		$this -> entryText('SlightLag','slightLag', '','');
		$this -> entryText('SeriousLag','seriousLag', '','');
		$this -> entryText('Unregistered','unregistered', '','');
		$this -> entryText('UnregisteredThree','unregisteredThree', '','');
		$this -> entryText('Graduates','graduates', '','');
		$this -> entryText('EnrolledNextGrade','enrolledNextGrade', '','');
		echo("</table>");
	}

}
?>
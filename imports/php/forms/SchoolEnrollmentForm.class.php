<?php
class SchoolEnrollmentForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('IdStudent','idStudent', '','');
		$this -> entryText('StartYear','startYear', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('SchoolGroup','schoolGroup', '','');
		$this -> entryText('Status','status', '','');
		$this -> entryText('FinalScore','finalScore', '','');
		$this -> entryText('IdCohorte','idCohorte', '','');
		$this -> entryText('InitialCohort','initialCohort', '','');
		echo("</table>");
	}

	public function editForm(SchoolEnrollment $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('IdStudent','idStudent', '','');
		$this -> entryText('StartYear','startYear', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('SchoolGroup','schoolGroup', '','');
		$this -> entryText('Status','status', '','');
		$this -> entryText('FinalScore','finalScore', '','');
		$this -> entryText('IdCohorte','idCohorte', '','');
		$this -> entryText('InitialCohort','initialCohort', '','');
		echo("</table>");
	}

}
?>
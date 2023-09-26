<?php
class SupervisorSchoolRegionForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('User','user', '','');
		$this -> entryText('SchoolRegionZone','schoolRegionZone', '','');
		echo("</table>");
	}

	public function editForm(SupervisorSchoolRegion $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('User','user', '','');
		$this -> entryText('SchoolRegionZone','schoolRegionZone', '','');
		echo("</table>");
	}

}
?>
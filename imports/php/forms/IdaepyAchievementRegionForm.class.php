<?php
class IdaepyAchievementRegionForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('SchoolRegion','schoolRegion', '','');
		$this -> entryText('Subject','subject', '','');
		$this -> entryText('Achievement','achievement', '','');
		$this -> entryText('Percentage','percentage', '','');
		$this -> entryText('Year','year', '','');
		echo("</table>");
	}

	public function editForm(IdaepyAchievementRegion $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('SchoolRegion','schoolRegion', '','');
		$this -> entryText('Subject','subject', '','');
		$this -> entryText('Achievement','achievement', '','');
		$this -> entryText('Percentage','percentage', '','');
		$this -> entryText('Year','year', '','');
		echo("</table>");
	}

}
?>
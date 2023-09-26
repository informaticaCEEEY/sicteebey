<?php
class IdaepyPercentageRegionForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('SchoolRegion','schoolRegion', '','');
		$this -> entryText('Subject','subject', '','');
		$this -> entryText('Percentage','percentage', '','');
		$this -> entryText('Evaluated','evaluated', '','');
		$this -> entryText('Year','year', '','');
		echo("</table>");
	}

	public function editForm(IdaepyPercentageRegion $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('SchoolRegion','schoolRegion', '','');
		$this -> entryText('Subject','subject', '','');
		$this -> entryText('Percentage','percentage', '','');
		$this -> entryText('Evaluated','evaluated', '','');
		$this -> entryText('Year','year', '','');
		echo("</table>");
	}

}
?>
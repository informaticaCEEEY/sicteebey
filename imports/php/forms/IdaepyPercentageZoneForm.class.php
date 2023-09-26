<?php
class IdaepyPercentageZoneForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('SchoolZone','schoolZone', '','');
		$this -> entryText('Subject','subject', '','');
		$this -> entryText('Percentage','percentage', '','');
		$this -> entryText('Evaluated','evaluated', '','');
		$this -> entryText('Year','year', '','');
		echo("</table>");
	}

	public function editForm(IdaepyPercentageZone $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('SchoolZone','schoolZone', '','');
		$this -> entryText('Subject','subject', '','');
		$this -> entryText('Percentage','percentage', '','');
		$this -> entryText('Evaluated','evaluated', '','');
		$this -> entryText('Year','year', '','');
		echo("</table>");
	}

}
?>
<?php
class IdaepyPercentageModeForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('SchoolMode','schoolMode', '','');
		$this -> entryText('Subject','subject', '','');
		$this -> entryText('Percentage','percentage', '','');
		$this -> entryText('Evaluated','evaluated', '','');
		$this -> entryText('Year','year', '','');
		echo("</table>");
	}

	public function editForm(IdaepyPercentageMode $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('SchoolMode','schoolMode', '','');
		$this -> entryText('Subject','subject', '','');
		$this -> entryText('Percentage','percentage', '','');
		$this -> entryText('Evaluated','evaluated', '','');
		$this -> entryText('Year','year', '','');
		echo("</table>");
	}

}
?>
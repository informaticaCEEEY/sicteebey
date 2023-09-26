<?php
class AchievementDescriptionForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Achievement','achievement', '','');
		$this -> entryText('Subject','subject', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('Description','description', '','');
		$this -> entryText('Year','year', '','');
		echo("</table>");
	}

	public function editForm(AchievementDescription $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Achievement','achievement', '','');
		$this -> entryText('Subject','subject', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('Description','description', '','');
		$this -> entryText('Year','year', '','');
		echo("</table>");
	}

}
?>
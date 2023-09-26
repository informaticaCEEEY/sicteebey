<?php
class AchievementIdaepyForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Achievement','achievement', '','');
		$this -> entryText('Year','year', '','');
		$this -> entryText('OrderNumber','orderNumber', '','');
		$this -> entryText('CodeR','codeR', '','');
		$this -> entryText('CodeG','codeG', '','');
		$this -> entryText('CodeB','codeB', '','');
		echo("</table>");
	}

	public function editForm(AchievementIdaepy $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Achievement','achievement', '','');
		$this -> entryText('Year','year', '','');
		$this -> entryText('OrderNumber','orderNumber', '','');
		$this -> entryText('CodeR','codeR', '','');
		$this -> entryText('CodeG','codeG', '','');
		$this -> entryText('CodeB','codeB', '','');
		echo("</table>");
	}

}
?>
<?php
class MayanLanguageForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('R57_R79','R57_R79', '','');
		$this -> entryText('R58_R80','R58_R80', '','');
		$this -> entryText('R59_R81','R59_R81', '','');
		$this -> entryText('R60_R84','R60_R84', '','');
		$this -> entryText('R61_R85','R61_R85', '','');
		echo("</table>");
	}

	public function editForm(MayanLanguage $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('R57_R79','R57_R79', '','');
		$this -> entryText('R58_R80','R58_R80', '','');
		$this -> entryText('R59_R81','R59_R81', '','');
		$this -> entryText('R60_R84','R60_R84', '','');
		$this -> entryText('R61_R85','R61_R85', '','');
		echo("</table>");
	}

}
?>
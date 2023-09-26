<?php
class FamilyContextForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('R13_R20','R13_R20', '','');
		$this -> entryText('R14_R21','R14_R21', '','');
		$this -> entryText('R15_R24','R15_R24', '','');
		$this -> entryText('R16_R25','R16_R25', '','');
		$this -> entryText('R40_R62','R40_R62', '','');
		echo("</table>");
	}

	public function editForm(FamilyContext $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('R13_R20','R13_R20', '','');
		$this -> entryText('R14_R21','R14_R21', '','');
		$this -> entryText('R15_R24','R15_R24', '','');
		$this -> entryText('R16_R25','R16_R25', '','');
		$this -> entryText('R40_R62','R40_R62', '','');
		echo("</table>");
	}

}
?>
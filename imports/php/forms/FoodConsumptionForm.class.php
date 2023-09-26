<?php
class FoodConsumptionForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('R17_R26','R17_R26', '','');
		$this -> entryText('R18_R27','R18_R27', '','');
		$this -> entryText('R19_R28','R19_R28', '','');
		$this -> entryText('R20_R29','R20_R29', '','');
		$this -> entryText('R21_R30','R21_R30', '','');
		$this -> entryText('R22_R31','R22_R31', '','');
		$this -> entryText('R23_R32','R23_R32', '','');
		$this -> entryText('R24_R33','R24_R33', '','');
		echo("</table>");
	}

	public function editForm(FoodConsumption $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('R17_R26','R17_R26', '','');
		$this -> entryText('R18_R27','R18_R27', '','');
		$this -> entryText('R19_R28','R19_R28', '','');
		$this -> entryText('R20_R29','R20_R29', '','');
		$this -> entryText('R21_R30','R21_R30', '','');
		$this -> entryText('R22_R31','R22_R31', '','');
		$this -> entryText('R23_R32','R23_R32', '','');
		$this -> entryText('R24_R33','R24_R33', '','');
		echo("</table>");
	}

}
?>
<?php
class DrinksConsumptionForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('R25_R34','R25_R34', '','');
		$this -> entryText('R26_R35','R26_R35', '','');
		$this -> entryText('R27_R36','R27_R36', '','');
		$this -> entryText('R28_R37','R28_R37', '','');
		$this -> entryText('R29_R38','R29_R38', '','');
		echo("</table>");
	}

	public function editForm(DrinksConsumption $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('R25_R34','R25_R34', '','');
		$this -> entryText('R26_R35','R26_R35', '','');
		$this -> entryText('R27_R36','R27_R36', '','');
		$this -> entryText('R28_R37','R28_R37', '','');
		$this -> entryText('R29_R38','R29_R38', '','');
		echo("</table>");
	}

}
?>
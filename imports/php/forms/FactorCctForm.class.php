<?php
class FactorCctForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('Factor','factor', '','');
		$this -> entryText('Media','media', '','');
		$this -> entryText('FactorCount','factorCount', '','');
		$this -> entryText('FactorSem','factorSem', '','');
		$this -> entryText('FactorMinimum','factorMinimum', '','');
		$this -> entryText('FactorMaximum','factorMaximum', '','');
		$this -> entryText('FactorSd','factorSd', '','');
		echo("</table>");
	}

	public function editForm(FactorCct $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('Factor','factor', '','');
		$this -> entryText('Media','media', '','');
		$this -> entryText('FactorCount','factorCount', '','');
		$this -> entryText('FactorSem','factorSem', '','');
		$this -> entryText('FactorMinimum','factorMinimum', '','');
		$this -> entryText('FactorMaximum','factorMaximum', '','');
		$this -> entryText('FactorSd','factorSd', '','');
		echo("</table>");
	}

}
?>
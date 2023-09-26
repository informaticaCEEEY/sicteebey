<?php
class FactorZoneForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Zone','zone', '','');
		$this -> entryText('Factor','factor', '','');
		$this -> entryText('Media','media', '','');
		$this -> entryText('FactorCount','factorCount', '','');
		echo("</table>");
	}

	public function editForm(FactorZone $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Zone','zone', '','');
		$this -> entryText('Factor','factor', '','');
		$this -> entryText('Media','media', '','');
		$this -> entryText('FactorCount','factorCount', '','');
		echo("</table>");
	}

}
?>
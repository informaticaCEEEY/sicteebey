<?php
class IndexZoneForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Zone','zone', '','');
		$this -> entryText('IndexList','indexList', '','');
		$this -> entryText('Media','media', '','');
		echo("</table>");
	}

	public function editForm(IndexZone $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Zone','zone', '','');
		$this -> entryText('IndexList','indexList', '','');
		$this -> entryText('Media','media', '','');
		echo("</table>");
	}

}
?>
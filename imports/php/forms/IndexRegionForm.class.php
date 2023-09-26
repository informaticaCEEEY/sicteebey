<?php
class IndexRegionForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Region','region', '','');
		$this -> entryText('IndexList','indexList', '','');
		$this -> entryText('Media','media', '','');
		echo("</table>");
	}

	public function editForm(IndexRegion $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Region','region', '','');
		$this -> entryText('IndexList','indexList', '','');
		$this -> entryText('Media','media', '','');
		echo("</table>");
	}

}
?>
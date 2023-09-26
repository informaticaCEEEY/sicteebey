<?php
class IndexCctForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('IndexList','indexList', '','');
		$this -> entryText('Media','media', '','');
		echo("</table>");
	}

	public function editForm(IndexCct $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('IndexList','indexList', '','');
		$this -> entryText('Media','media', '','');
		echo("</table>");
	}

}
?>
<?php
class IndexStateForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('IndexList','indexList', '','');
		$this -> entryText('Media','media', '','');
		$this -> entryText('Total','total', '','');
		echo("</table>");
	}

	public function editForm(IndexState $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('IndexList','indexList', '','');
		$this -> entryText('Media','media', '','');
		$this -> entryText('Total','total', '','');
		echo("</table>");
	}

}
?>
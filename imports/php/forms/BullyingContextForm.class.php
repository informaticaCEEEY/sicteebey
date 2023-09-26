<?php
class BullyingContextForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P9O1','P9O1', '','');
		$this -> entryText('P9O2','P9O2', '','');
		$this -> entryText('P9O3','P9O3', '','');
		$this -> entryText('P9O4','P9O4', '','');
		echo("</table>");
	}

	public function editForm(BullyingContext $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P9O1','P9O1', '','');
		$this -> entryText('P9O2','P9O2', '','');
		$this -> entryText('P9O3','P9O3', '','');
		$this -> entryText('P9O4','P9O4', '','');
		echo("</table>");
	}

}
?>
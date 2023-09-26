<?php
class TraditionsContextForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P11O2','P11O2', '','');
		$this -> entryText('P11O3','P11O3', '','');
		$this -> entryText('P11O4','P11O4', '','');
		echo("</table>");
	}

	public function editForm(TraditionsContext $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P11O2','P11O2', '','');
		$this -> entryText('P11O3','P11O3', '','');
		$this -> entryText('P11O4','P11O4', '','');
		echo("</table>");
	}

}
?>
<?php
class EthnicIdentityContextForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P10O1','P10O1', '','');
		$this -> entryText('P10O2','P10O2', '','');
		$this -> entryText('P10O3','P10O3', '','');
		$this -> entryText('P10O5','P10O5', '','');
		$this -> entryText('P11O5','P11O5', '','');
		$this -> entryText('P11O6','P11O6', '','');
		$this -> entryText('P11O7','P11O7', '','');
		echo("</table>");
	}

	public function editForm(EthnicIdentityContext $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P10O1','P10O1', '','');
		$this -> entryText('P10O2','P10O2', '','');
		$this -> entryText('P10O3','P10O3', '','');
		$this -> entryText('P10O5','P10O5', '','');
		$this -> entryText('P11O5','P11O5', '','');
		$this -> entryText('P11O6','P11O6', '','');
		$this -> entryText('P11O7','P11O7', '','');
		echo("</table>");
	}

}
?>
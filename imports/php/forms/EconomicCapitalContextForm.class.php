<?php
class EconomicCapitalContextForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P1O1','P1O1', '','');
		$this -> entryText('P1O2','P1O2', '','');
		$this -> entryText('P2O1','P2O1', '','');
		$this -> entryText('P2O2','P2O2', '','');
		$this -> entryText('P2O3','P2O3', '','');
		$this -> entryText('P2O4','P2O4', '','');
		$this -> entryText('P2O5','P2O5', '','');
		$this -> entryText('P2O6','P2O6', '','');
		echo("</table>");
	}

	public function editForm(EconomicCapitalContext $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Folio','folio', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('P1O1','P1O1', '','');
		$this -> entryText('P1O2','P1O2', '','');
		$this -> entryText('P2O1','P2O1', '','');
		$this -> entryText('P2O2','P2O2', '','');
		$this -> entryText('P2O3','P2O3', '','');
		$this -> entryText('P2O4','P2O4', '','');
		$this -> entryText('P2O5','P2O5', '','');
		$this -> entryText('P2O6','P2O6', '','');
		echo("</table>");
	}

}
?>
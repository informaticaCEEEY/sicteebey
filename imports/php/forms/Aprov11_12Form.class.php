<?php
class Aprov11_12Form extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('IdStudent','idStudent', '','');
		$this -> entryText('Year','year', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('Group1','group1', '','');
		$this -> entryText('Status','status', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('CalGlobal','calGlobal', '','');
		echo("</table>");
	}

	public function editForm(Aprov11_12 $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('IdStudent','idStudent', '','');
		$this -> entryText('Year','year', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('Group1','group1', '','');
		$this -> entryText('Status','status', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('CalGlobal','calGlobal', '','');
		echo("</table>");
	}

}
?>
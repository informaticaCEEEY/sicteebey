<?php
class AffectiveEnvironmentForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('R43_R64','R43_R64', '','');
		$this -> entryText('R44_R65','R44_R65', '','');
		$this -> entryText('R45_R66','R45_R66', '','');
		$this -> entryText('R46_R67','R46_R67', '','');
		$this -> entryText('R47_R68','R47_R68', '','');
		$this -> entryText('R48_R69','R48_R69', '','');
		$this -> entryText('R49_R71','R49_R71', '','');
		$this -> entryText('R50_R72','R50_R72', '','');
		echo("</table>");
	}

	public function editForm(AffectiveEnvironment $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('R43_R64','R43_R64', '','');
		$this -> entryText('R44_R65','R44_R65', '','');
		$this -> entryText('R45_R66','R45_R66', '','');
		$this -> entryText('R46_R67','R46_R67', '','');
		$this -> entryText('R47_R68','R47_R68', '','');
		$this -> entryText('R48_R69','R48_R69', '','');
		$this -> entryText('R49_R71','R49_R71', '','');
		$this -> entryText('R50_R72','R50_R72', '','');
		echo("</table>");
	}

}
?>
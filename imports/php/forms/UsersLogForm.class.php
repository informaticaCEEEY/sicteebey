<?php
class UsersLogForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('User','user', '','');
		$this -> entryText('ActivityDate','activityDate', '','');
		$this -> entryText('Activity','activity', '','');
		echo("</table>");
	}

	public function editForm(UsersLog $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('User','user', '','');
		$this -> entryText('ActivityDate','activityDate', '','');
		$this -> entryText('Activity','activity', '','');
		echo("</table>");
	}

}
?>
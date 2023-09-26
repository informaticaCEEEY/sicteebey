<?php
class AprovStatusForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cohorte','cohorte', '','');
		$this -> entryText('SchoolPeriod','schoolPeriod', '','');
		$this -> entryText('StatusA','statusA', '','');
		$this -> entryText('StatusR','statusR', '','');
		$this -> entryText('StatusX','statusX', '','');
		$this -> entryText('StatusZ','statusZ', '','');
		echo("</table>");
	}

	public function editForm(AprovStatus $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cohorte','cohorte', '','');
		$this -> entryText('SchoolPeriod','schoolPeriod', '','');
		$this -> entryText('StatusA','statusA', '','');
		$this -> entryText('StatusR','statusR', '','');
		$this -> entryText('StatusX','statusX', '','');
		$this -> entryText('StatusZ','statusZ', '','');
		echo("</table>");
	}

}
?>
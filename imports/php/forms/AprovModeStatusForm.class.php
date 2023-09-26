<?php
class AprovModeStatusForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cohorte','cohorte', '','');
		$this -> entryText('SchoolPeriod','schoolPeriod', '','');
		$this -> entryText('Mode','mode', '','');
		$this -> entryText('StatusA','statusA', '','');
		$this -> entryText('StatusR','statusR', '','');
		$this -> entryText('StatusX','statusX', '','');
		$this -> entryText('StatusZ','statusZ', '','');
		$this -> entryText('UnregisteredThree','unregisteredThree', '','');
		echo("</table>");
	}

	public function editForm(AprovModeStatus $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cohorte','cohorte', '','');
		$this -> entryText('SchoolPeriod','schoolPeriod', '','');
		$this -> entryText('Mode','mode', '','');
		$this -> entryText('StatusA','statusA', '','');
		$this -> entryText('StatusR','statusR', '','');
		$this -> entryText('StatusX','statusX', '','');
		$this -> entryText('StatusZ','statusZ', '','');
		$this -> entryText('UnregisteredThree','unregisteredThree', '','');
		echo("</table>");
	}

}
?>
<?php
class ContextReportForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('YearApplication','yearApplication', '','');
		$this -> entryText('GroupbyPeriod','groupbyPeriod', '','');
		echo("</table>");
	}

	public function editForm(ContextReport $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('YearApplication','yearApplication', '','');
		$this -> entryText('GroupbyPeriod','groupbyPeriod', '','');
		echo("</table>");
	}

}
?>
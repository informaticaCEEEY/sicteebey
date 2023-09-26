<?php
class ContextApplicationForm extends AbstractForm{

	private function exploitList($array) {

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione un año'));
		foreach ($array as $yearAppl) {
			array_push($exploit, array('value' => $yearAppl->getId(), 'label' => $yearAppl->getYearApplication()));
		}
		return $exploit;
	}

	private function exploitGroupby($array) {

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione un ciclo escolar'));
		foreach ($array as $groupByPeriod) {
			array_push($exploit, array('value' => $groupByPeriod->getGroupByPeriodObject()->getEndYear(), 'label' => $groupByPeriod->getGroupByPeriodObject()->getName()));
		}
		return $exploit;
	}

	public function reportForm($idContextApplication, $type){

		$controller = new ContextReportController();
		$where = 'year_application = :yearApplication';
		$whereFields = array('yearApplication' => $idContextApplication);
		$groupbyList = $this -> exploitGroupby($controller -> displayByAction($where, $whereFields));

		$this -> hidden('action', 'view');
		$this -> hidden('year', $idContextApplication);
		$this -> hidden('type', $type);
		//echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Reporte por Aula');
		//$this -> select2('Año de Aplicación', 'year', '', $applicationYears,'','','Año de Aplicación', 'required', 'Seleccione un año');
		//echo('<div id="groupbyPeriod">');
		$this -> select2('Agrupados por el ciclo escolar', 'groupby', '', $groupbyList,'','','Ciclo escolar', 'required', 'Seleccione un ciclo escolar');
		//echo('</div>');
		$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', 'data-validation="alphanumeric" data-validation-error-msg="Ingrese la Clave del Centro de Trabajo"', 10);
		//echo("</table>");
	}

	public function reportFormDirector($idContextApplication, $cct, $type){

		$controller = new ContextReportController();
		$where = 'year_application = :yearApplication';
		$whereFields = array('yearApplication' => $idContextApplication);
		$groupbyList = $this -> exploitGroupby($controller -> displayByAction($where, $whereFields));

		$this -> hidden('action', 'view');
		$this -> hidden('year', $idContextApplication);
		$this -> hidden('cct', $cct);
		$this -> hidden('type', $type);
		//echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Reporte por Aula');
		//$this -> select2('Año de Aplicación', 'year', '', $applicationYears,'','','Año de Aplicación', 'required', 'Seleccione un año');
		//echo('<div id="groupbyPeriod">');
		$this -> select2('Agrupados por el ciclo escolar', 'groupby', '', $groupbyList,'','','Ciclo escolar', 'required', 'Seleccione un ciclo escolar');
		//echo('</div>');
		//echo("</table>");
	}

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('YearApplication','yearApplication', '','');
		echo("</table>");
	}

	public function editForm(ContextApplication $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('YearApplication','yearApplication', '','');
		echo("</table>");
	}

}
?>

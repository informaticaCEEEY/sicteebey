<?php
class CohorteForm extends AbstractForm{

	private function exploitCohorte($array) {

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione una cohorte'));
		foreach ($array as $cohorte) {

			array_push($exploit, array('value' => $cohorte -> getId(), 'label' => $cohorte->__toString()));
		}
		return $exploit;
	}

	private function exploitTown($array) {

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione un municipio'));
		foreach ($array as $town) {

			array_push($exploit, array('value' => $town -> getId(), 'label' => $town->getName()));
		}
		return $exploit;
	}

	private function exploitSchool($array) {

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione una escuela'));
		foreach ($array as $school) {

			array_push($exploit, array('value' => $school -> getCct(), 'label' => $school->getCct()));
		}
		return $exploit;
	}

	private function exploitRegion($array) {

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione una regi&oacute;n'));
		foreach ($array as $entry) {
			array_push($exploit, array('value' => $entry -> getId(), 'label' => $entry->getName()));
		}
		return $exploit;
	}

	private function exploitSchoolRegion() {

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione una regi&oacute;n'));
		return $exploit;
	}

	private function exploitSchoolMode() {

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione una modalidad'));
		return $exploit;
	}

	private function exploitSchoolZone() {

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione una zona escolar'));
		return $exploit;
	}

	private function exploitSchoolLevel($array) {

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione un nivel educativo'));
		foreach ($array as $schoolLevel) {

			array_push($exploit, array('value' => $schoolLevel -> getId(), 'label' => $schoolLevel->getName()));
		}
		return $exploit;
	}

	public function reportGenSchoolForm(){

		$controller = new CohorteController();
		$cohortes = $this -> exploitCohorte($controller -> displayAction());

		/*$controller = new SchoolController();
		$schools = $this -> exploitSchool($controller -> displayAction());

		$controller = new TownController();
		$towns = $this -> exploitTown($controller -> displayAction());*/

		$this -> hidden('action', 'view');
		//echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Reporte por escuela');
		$this -> select2('Cohorte', 'cohorte', '', $cohortes,'','','Cohorte');
		$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', '', 10);
		/*$this -> select('Municipio', 'town', '', $towns,'','','Municipio', 'required', 'Seleccione un municipio');
		echo('<div id="schoolTown">');
		$this -> select('Escuela', 'school', '', $schools,'','TRUE','Escuela', 'required', 'Seleccione una escuela');
		echo('</div>');*/
		//echo("</table>");
	}

	public function reportZoneForm(){

		$controller = new CohorteController();
		$cohortes = $this -> exploitCohorte($controller -> displayAction());

		$controller = new SchoolLevelController();
		$where = 'e.id = 2 OR e.id = 3';
		$schoolLevel = $this -> exploitSchoolLevel($controller -> displayByAction($where));

		$schoolRegion = $this -> exploitSchoolRegion();
		$schoolMode = $this -> exploitSchoolMode();
		$schoolZone = $this -> exploitSchoolZone();

		$this -> hidden('action', 'view');
		//echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Reporte por zona');
		$this -> select2('Cohorte', 'cohorte', '', $cohortes,'','','Seleccione una Regi&oacute;n');
		$this -> select2('Nivel Educativo', 'schoolLevel', '', $schoolLevel,'','','Cohorte');

		// echo('<div id="schoolRegion1">');
		// $this -> select2('Regi&oacute;n', 'schoolRegion', '', $schoolRegion,'','TRUE','Cohorte');
		// echo('</div>');

		echo('<div id="schoolMode1">');
		$this -> select2('Modalidad', 'schoolMode', '', $schoolMode,'','TRUE','Modalidad');
		echo('</div>');

		echo('<div id="schoolZone1">');
		$this -> select2('Zona escolar', 'schoolZone', '', $schoolZone,'','TRUE','Zona escolar');
		echo('</div>');
	}

	public function reportRegionForm(){

		$controller = new CohorteController();
		$cohortes = $this -> exploitCohorte($controller -> displayAction());

		$controller = new SchoolLevelController();
		$where = 'e.id = 2';
		$schoolLevel = $this -> exploitSchoolLevel($controller -> displayByAction($where));

		$controller = new SchoolRegionController();
		$where = 'e.id <= 16';
		$schoolRegion = $this -> exploitRegion($controller -> displayByAction($where));

		$this -> hidden('action', 'view');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Reporte por región');
		$this -> select2('Cohorte', 'cohorte', '', $cohortes,'','','Seleccione una Cohorte');
		$this -> select2('Nivel Educativo', 'schoolLevel', '', $schoolLevel,'','', 'Seleccione un Nivel');
		$this -> select2('Regi&oacute;n', 'schoolRegion', '', $schoolRegion,'','', 'Seleccione una Regi&oacute;n');
		echo("</table>");
	}

	public function reportRegionSupervisorForm($schoolRegion){

		$controller = new CohorteController();
		$cohortes = $this -> exploitCohorte($controller -> displayAction());

		$controller = new SchoolLevelController();
		$where = 'e.id = 2';
		$schoolLevel = $this -> exploitSchoolLevel($controller -> displayByAction($where));

		$this -> hidden('action', 'view');
		$this -> hidden('schoolRegion', $schoolRegion);
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Reporte por región');
		$this -> select2('Cohorte', 'cohorte', '', $cohortes,'','','Seleccione una Cohorte');
		$this -> select2('Nivel Educativo', 'schoolLevel', '', $schoolLevel,'','', 'Seleccione un Nivel');
		echo("</table>");
	}

	public function reportZoneSupervisorForm($schoolLevel, $schoolMode, $schoolZone){

		$controller = new CohorteController();
		$cohortes = $this -> exploitCohorte($controller -> displayAction());

		$this -> hidden('action', 'view');
		$this -> hidden('schoolLevel', $schoolLevel);
		$this -> hidden('schoolMode', $schoolMode);
		$this -> hidden('schoolZone', $schoolZone);
		//echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Reporte por zona');
		$this -> select2('Cohorte', 'cohorte', '', $cohortes,'','','Cohorte', 'required', 'Seleccione una Cohorte');
		//echo("</table>");
	}

	public function reportGenSchoolDirectorForm($school){

		$controller = new CohorteController();
		$cohortes = $this -> exploitCohorte($controller -> displayAction());

		/*$controller = new SchoolController();
		$schools = $this -> exploitSchool($controller -> displayAction());

		$controller = new TownController();
		$towns = $this -> exploitTown($controller -> displayAction());*/

		$this -> hidden('action', 'view');
		$this -> hidden('school', $school);
		//echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Reporte por escuela');
		$this -> select2('Cohorte', 'cohorte', '', $cohortes,'','','Cohorte', 'required', 'Seleccione una cohorte');
		//$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', 'data-validation="required" data-validation-error-msg="Ingrese la Clave del Centro de Trabajo"');
		/*$this -> select('Municipio', 'town', '', $towns,'','','Municipio', 'required', 'Seleccione un municipio');
		echo('<div id="schoolTown">');
		$this -> select('Escuela', 'school', '', $schools,'','TRUE','Escuela', 'required', 'Seleccione una escuela');
		echo('</div>');*/
		//echo("</table>");
	}

	public function reportGenForm(){

		$controller = new CohorteController();
		$cohortes = $this -> exploitCohorte($controller -> displayAction());

		$this -> hidden('action', 'view');
		//echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Reporte General');
		$this -> select2('Cohorte', 'cohorte', '', $cohortes,'','','Cohorte', 'required', 'Seleccione una Cohorte');
		//echo("</table>");
	}

	public function reportSexForm(){

		$controller = new CohorteController();
		$cohortes = $this -> exploitCohorte($controller -> displayAction());

		$this -> hidden('action', 'view');
		//echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Reporte por sexo');
		$this -> select2('Cohorte', 'cohorte', '', $cohortes,'','','Cohorte', 'required', 'Seleccione una Cohorte');
		//echo("</table>");
	}

	public function reportModForm(){

		$controller = new CohorteController();
		$cohortes = $this -> exploitCohorte($controller -> displayAction());

		$this -> hidden('action', 'view');
		//echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Reporte por modalidad');
		$this -> select2('Cohorte', 'cohorte', '', $cohortes,'','','Cohorte', 'required', 'Seleccione una Cohorte');
		//echo("</table>");
	}

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Name','name', '','');
		$this -> entryText('TableCohorte','tableCohorte', '','');
		echo("</table>");
	}

	public function editForm(Cohorte $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Name','name', '','');
		$this -> entryText('TableCohorte','tableCohorte', '','');
		echo("</table>");
	}

}
?>

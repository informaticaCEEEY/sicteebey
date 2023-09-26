<?php
class FactorForm extends AbstractForm{

	private function exploitFactors($array) {

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione un factor'));
		foreach ($array as $entry) {
			array_push($exploit, array('value' => $entry -> getId(), 'label' => $entry->getName()));
		}
		return $exploit;
	}

	private function exploitGradeList($array) {

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione un sal&oacute;n'));
		foreach ($array as $entry) {

			array_push($exploit, array('value' => $entry -> getId(), 'label' => $entry->getGrade() . '&deg; ' . $entry->getSchoolGroup()));
		}
		return $exploit;
	}

	private function exploitSchoolRegion($array) {

		$exploit = array();
		array_push($exploit, array('value' => '0', 'label' => 'Seleccione una regi&oacute;n'));
		foreach ($array as $schoolRegion) {

			array_push($exploit, array('value' => $schoolRegion -> getId(), 'label' => $schoolRegion->getName()));
		}
		return $exploit;
	}

	private function exploitSchoolLevel($array) {

		$exploit = array();
		array_push($exploit, array('value' => '0', 'label' => 'Seleccione una regi&oacute;n'));
		array_push($exploit, array('value' => '2', 'label' => 'Primaria'));
		array_push($exploit, array('value' => '3', 'label' => 'Secundaria'));
		return $exploit;
	}

	private function exploitSchoolLevel2($array) {

		$exploit = array();
		array_push($exploit, array('value' => '0', 'label' => 'Seleccione un nivel'));
		foreach ($array as $schoolLevel) {
			array_push($exploit, array('value' => $schoolLevel -> getId(), 'label' => $schoolLevel->getName()));
		}
		return $exploit;
	}

	private function exploitSchoolMode($array = '') {

		$exploit = array();
		array_push($exploit, array('value' => '0', 'label' => 'Seleccione una modalidad'));
		foreach ($array as $schoolMode) {
			array_push($exploit, array('value' => $schoolMode -> getId(), 'label' => $schoolMode->getName()));
		}
		return $exploit;
	}

	private function exploitSchoolZone() {

		$exploit = array();
		array_push($exploit, array('value' => '0', 'label' => 'Seleccione una zona escolar'));
		return $exploit;
	}

	public function addForm($year='', $type='', $level=''){
		$controller = new FactorController();
		$where = "year_application = :year AND type = :type";
		$whereFields = array('year' => $year, 'type' => $type);
		$factors = $this -> exploitFactors($controller -> displayByAction($where, $whereFields, '', 'e.name'));

		$this -> hidden('action', 'add');
		$this -> hidden('year', $year);
		$this -> hidden('type', $type);
		$this -> hidden('level', $level);
		echo("<table width='100%' border='0' class='tableForm'>");
		//$this -> formHeader('Reporte General');
		$this -> select2('Seleccione un factor', 'factor', '', $factors,'','','Seleccione un factor', 'required', 'Seleccione un factor');
		echo("</table>");
	}

	public function contextSchoolForm(){

		$controller = new FactorController();
		$where = "id != :factor";
		$factors = $this -> exploitFactors($controller -> displayByAction($where, array('factor' => 5), '', 'e.name'));

		$this -> hidden('action', 'viewSchool');
		echo("<table width='100%' border='0' class='tableForm'>");
		//$this -> formHeader('Reporte por Escuela');
		$this -> select2('Seleccione un factor', 'factor', '', $factors,'','','', 'required', 'Seleccione un factor');
		$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', 'data-validation="required" data-validation-error-msg="Ingrese la Clave del Centro de Trabajo"');
		echo("</table>");
	}

	public function contextFactorForm($school, $contextYear, $type){

		$controller = new FactorController();
		$where = "year_application = :yearApplication AND type = :type";
		$whereFields = array('yearApplication' => $contextYear, 'type' => $type);
		$factors = $this -> exploitFactors($controller -> displayByAction($where, $whereFields, '', 'e.name'));

		$this -> hidden('action', 'viewSchool');
		$this -> hidden('cct', $school);
		$this -> hidden('year', $contextYear);
		$this -> hidden('type', $type);
		echo("<table width='100%' border='0' class='tableForm'>");
		//$this -> formHeader('Reporte por Escuela');
		$this -> select2('Seleccione un factor', 'factor', '', $factors,'','','Seleccione un factor', 'required', 'Seleccione un factor');
		//$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', 'data-validation="required" data-validation-error-msg="Ingrese la Clave del Centro de Trabajo"');
		echo("</table>");
	}

	public function contextFactorZoneForm($schoolZone, $contextYear, $type, $schoolLevel, $schoolMode){

		$controller = new FactorController();
		$where = "year_application = :yearApplication and type = :type";
		$whereFields = array('yearApplication' => $contextYear, 'type' => $type);
		$factors = $this -> exploitFactors($controller -> displayByAction($where, $whereFields, '', 'e.name'));

		$this -> hidden('action', 'viewZone');
		$this -> hidden('schoolZone', $schoolZone);
		$this -> hidden('schoolLevel', $schoolLevel);
		$this -> hidden('schoolMode', $schoolMode);
		$this -> hidden('type', $type);
		echo("<table width='100%' border='0' class='tableForm'>");
		//$this -> formHeader('Reporte por Escuela');
		$this -> select2('Seleccione un factor', 'factor', '', $factors,'','','Seleccione un factor', 'required', 'Seleccione un factor');
		//$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', 'data-validation="required" data-validation-error-msg="Ingrese la Clave del Centro de Trabajo"');
		echo("</table>");
	}

	public function contextFactorIndexDirectorForm($indexList){

		$controller = new FactorController();
		$join = 'INNER JOIN factors_index on factors_index.factor = e.id';
		$where = "factors_index.index_list = :indexList";
		$whereFields = array('indexList' => $indexList);
		$factors = $this -> exploitFactors($controller -> displayByAction($where, $whereFields, $join, 'e.name'));

		$this -> hidden('action', 'add');
		$this -> hidden('indexList', $indexList);
		echo("<table width='100%' border='0' class='tableForm'>");
		//$this -> formHeader('Reporte por Escuela');
		$this -> select2('Seleccione un factor', 'factor', '', $factors,'','','Seleccione un factor', 'required', 'Seleccione un factor');
		//$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', 'data-validation="required" data-validation-error-msg="Ingrese la Clave del Centro de Trabajo"');
		echo("</table>");
	}

	public function contextFactorDirectorForm($school, $indexList){

		$controller = new FactorController();
		$join = 'INNER JOIN factors_index on factors_index.factor = e.id';
		$where = "factors_index.index_list = :indexList";
		$whereFields = array('indexList' => $indexList);
		$factors = $this -> exploitFactors($controller -> displayByAction($where, $whereFields, $join, 'e.name'));

		$this -> hidden('action', 'viewSchool');
		$this -> hidden('cct', $school);
		$this -> hidden('indexList', $indexList);
		echo("<table width='100%' border='0' class='tableForm'>");
		//$this -> formHeader('Reporte por Escuela');
		$this -> select2('Seleccione un factor', 'factor', '', $factors,'','','Seleccione un factor', 'required', 'Seleccione un factor');
		//$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', 'data-validation="required" data-validation-error-msg="Ingrese la Clave del Centro de Trabajo"');
		echo("</table>");
	}

	public function contextFactorZoneDirectorForm($schoolZone, $indexList){

		$controller = new FactorController();
		$join = 'INNER JOIN factors_index on factors_index.factor = e.id';
		$where = "factors_index.index_list = :indexList";
		$whereFields = array('indexList' => $indexList);
		$factors = $this -> exploitFactors($controller -> displayByAction($where, $whereFields, $join, 'e.name'));

		$this -> hidden('action', 'viewZone');
		$this -> hidden('schoolZone', $schoolZone);
		$this -> hidden('indexList', $indexList);
		echo("<table width='100%' border='0' class='tableForm'>");
		//$this -> formHeader('Reporte por Escuela');
		$this -> select2('Seleccione un factor', 'factor', '', $factors,'','','Seleccione un factor', 'required', 'Seleccione un factor');
		//$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', 'data-validation="required" data-validation-error-msg="Ingrese la Clave del Centro de Trabajo"');
		echo("</table>");
	}

	public function contextFactorGroupForm($school, $year='', $groupby='', $type=''){

		$controller = new FactorController();
		$where = "id != :factor AND id < 9";
		$factors = $this -> exploitFactors($controller -> displayByAction($where, array('factor' => 5), '', 'e.name'));

		$controller = new  IdaepyController();
		$where = "cct = :cct AND year = :year AND type = :type";
		$whereFields = array('cct' => $school, 'year' => $groupby, 'type' => 2);
		$gradeList = $this -> exploitGradeList($controller -> displayByAction($where, $whereFields));

		$this -> hidden('action', 'viewSchoolGroup');
		$this -> hidden('cct', $school);
		$this -> hidden('year', $year);
		$this -> hidden('groupby', $groupby);
		$this -> hidden('type', $type);
		echo("<table width='100%' border='0' class='tableForm'>");
		//$this -> formHeader('Reporte por Escuela');
		$this -> select2('Seleccione un sal&oacute;n', 'schoolGroup', '', $gradeList,'','','Seleccione un sal&oacute;n', 'required', 'Seleccione un sal&oacute;n');
		//$this -> select2('Seleccione un factor', 'factor', '', $factors,'','','Seleccione un factor', 'required', 'Seleccione un factor');
		//$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', 'data-validation="required" data-validation-error-msg="Ingrese la Clave del Centro de Trabajo"');
		echo("</table>");
	}

	public function contextFactorGroupForm2($school){

		$controller = new FactorController();
		$where = "id != :factor AND id < 9";
		$factors = $this -> exploitFactors($controller -> displayByAction($where, array('factor' => 5), '', 'e.name'));

		$controller = new  IdaepyController();
		$where = "cct = :cct AND year = :year AND type = :type";
		$gradeList = $this -> exploitGradeList($controller -> displayByAction($where, array('cct' => $school, 'year' => '2015'
		, 'type' => '2')));

		$this -> hidden('action', 'viewSchoolGroup');
		$this -> hidden('cct', $school);
		echo("<table width='100%' border='0' class='tableForm'>");
		//$this -> formHeader('Reporte por Escuela');
		$this -> select2('Seleccione un sal&oacute;n', 'schoolGroup', '', $gradeList,'','','Seleccione un sal&oacute;n', 'required', 'Seleccione un sal&oacute;n');
		//$this -> select2('Seleccione un factor', 'factor', '', $factors,'','','Seleccione un factor', 'required', 'Seleccione un factor');
		//$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', 'data-validation="required" data-validation-error-msg="Ingrese la Clave del Centro de Trabajo"');
		echo("</table>");
	}

	public function contextFactorSchoolGroupForm($schoolGroup, $cct, $year='', $groupby='', $type){

		$idaepyController = new IdaepyController();
		$schoolGroupObject = $idaepyController->getEntityAction($schoolGroup);

		$controller = new FactorController();
		$join = 'INNER JOIN factor_grade ON factor_grade.factor = e.id';
		$where = "e.year_application = :year AND factor_grade.grade = :grade";
		$whereFields = array('grade' => $schoolGroupObject->getGrade(), 'year' => $year);
		$factors = $this -> exploitFactors($controller -> displayByAction($where, $whereFields, $join, 'e.name'));

		/*
		$controller = new  IdaepyController();
		$where = "cct = :cct AND year = :year";
		$gradeList = $this -> exploitGradeList($controller -> displayByAction($where, array('cct' => $school, 'year' => '2016')));
		*/
		$this -> hidden('action', 'viewSchoolGroup');
		$this -> hidden('schoolGroup', $schoolGroup);
		$this -> hidden('cct', $cct);
		$this -> hidden('year', $year);
		$this -> hidden('groupby', $groupby);
		$this -> hidden('type', $type);
		echo("<table width='100%' border='0' class='tableForm'>");
		//$this -> formHeader('Reporte por Escuela');
		//$this -> select2('Seleccione un sal&oacute;n', 'schoolGroup', '', $gradeList,'','','Seleccione un sal&oacute;n', 'required', 'Seleccione un sal&oacute;n');
		$this -> select2('Seleccione un factor', 'factor', '', $factors,'','','Seleccione un factor', 'required', 'Seleccione un factor');
		//$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', 'data-validation="required" data-validation-error-msg="Ingrese la Clave del Centro de Trabajo"');
		echo("</table>");
	}

	public function contextFactorSchoolGroupForm2($schoolGroup, $cct){

		$controller = new FactorController();
		$where = "id != :factor AND id < 9";
		$factors = $this -> exploitFactors($controller -> displayByAction($where, array('factor' => 5), '', 'e.name'));
		/*
		$controller = new  IdaepyController();
		$where = "cct = :cct AND year = :year";
		$gradeList = $this -> exploitGradeList($controller -> displayByAction($where, array('cct' => $school, 'year' => '2016')));
		*/
		$this -> hidden('action', 'viewSchoolGroup2');
		$this -> hidden('schoolGroup', $schoolGroup);
		$this -> hidden('cct', $cct);
		echo("<table width='100%' border='0' class='tableForm'>");
		//$this -> formHeader('Reporte por Escuela');
		//$this -> select2('Seleccione un sal&oacute;n', 'schoolGroup', '', $gradeList,'','','Seleccione un sal&oacute;n', 'required', 'Seleccione un sal&oacute;n');
		$this -> select2('Seleccione un factor', 'factor', '', $factors,'','','Seleccione un factor', 'required', 'Seleccione un factor');
		//$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', 'data-validation="required" data-validation-error-msg="Ingrese la Clave del Centro de Trabajo"');
		echo("</table>");
	}

	public function contextSchoolXForm($year='', $groupby='', $type=''){

		$this -> hidden('action', 'viewSchoolGraph');
		$this -> hidden('year', $year);
		$this -> hidden('groupby', $groupby);
		$this -> hidden('type', $type);
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', 'data-validation="alphanumeric" data-validation-error-msg="Ingrese la Clave del Centro de Trabajo"', 10);
		echo("</table>");
	}

	public function contextSchool2Form(){

		$controller = new FactorController();
		$where = "id != :factor";
		$factors = $this -> exploitFactors($controller -> displayByAction($where, array('factor' => 5)));

		$this -> hidden('action', 'viewSchoolGraph');
		$this -> hidden('year', '2016');
		echo("<table width='100%' border='0' class='tableForm'>");
		//$this -> formHeader('Reporte por Escuela');
		//$this -> select2('Seleccione un factor', 'factor', '', $factors,'','','', 'required', 'Seleccione una factor');
		$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', 'data-validation="alphanumeric" data-validation-error-msg="Ingrese la Clave del Centro de Trabajo"', 10);
		echo("</table>");
	}

	public function contextSchool3Form(){

		$controller = new FactorController();
		$where = "id != :factor";
		$factors = $this -> exploitFactors($controller -> displayByAction($where, array('factor' => 5)));

		$this -> hidden('action', 'viewSchoolGraph');
		$this -> hidden('year', '2017');
		echo("<table width='100%' border='0' class='tableForm'>");
		//$this -> formHeader('Reporte por Escuela');
		//$this -> select2('Seleccione un factor', 'factor', '', $factors,'','','', 'required', 'Seleccione una factor');
		$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', 'data-validation="required" data-validation-error-msg="Ingrese la Clave del Centro de Trabajo"', 10);
		echo("</table>");
	}

	public function contextSchoolDirectorForm($school){

		$controller = new FactorController();
		$where = "id != :factor";
		$factors = $this -> exploitFactors($controller -> displayByAction($where, array('factor' => 5), '', 'e.name'));

		$this -> hidden('action', 'viewSchool');
		$this -> hidden('school', $school);
		echo("<table width='100%' border='0' class='tableForm'>");
		//$this -> formHeader('Reporte por Escuela');
		$this -> select2('Seleccione un factor', 'factor', '', $factors,'','','Cohorte', 'required', 'Seleccione un factor');
		//$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', 'data-validation="required" data-validation-error-msg="Ingrese la Clave del Centro de Trabajo"');
		echo("</table>");
	}

	public function contextZoneForm($year='', $type=''){

		$controller = new SchoolRegionController();
		$where = 'e.id < 17';
		$schoolRegion = $this -> exploitSchoolRegion($controller -> displayByAction($where));
		$schoolLevelController = new SchoolLevelController();
		$where = 'e.id < 4';
		$schoolLevel = $this -> exploitSchoolLevel2($schoolLevelController -> displayByAction($where));
		//$schoolLevel = $this -> exploitSchoolLevel();
		$schoolZone = $this -> exploitSchoolZone();

		$this -> hidden('action', 'viewZone');
		$this -> hidden('year', $year);
		$this -> hidden('type', $type);

		if($type == 2){
			$schoolMode = $this -> exploitSchoolMode();
			echo('<div id="schoolLevel1">');
			$this -> select2('Nivel', 'schoolLevel', '', $schoolLevel,'','','Nivel');
			echo('</div>');

			echo('<div id="schoolMode1">');
			$this -> select2('Modalidad', 'schoolMode', '', $schoolMode,'','TRUE','Modalidad', 'required', 'Seleccione una Opción');
			echo('</div>');
		}else{
			$this -> hidden('schoolLevel', 2);

			$controller = new SchoolModeController();
			$where = 'e.id = 4 OR e.id = 5';
			$schoolMode = $this -> exploitSchoolMode($controller -> displayByAction($where));

			echo('<div id="schoolMode1">');
			$this -> select2('Modalidad', 'schoolMode', '', $schoolMode,'','','Modalidad', 'required', 'Seleccione una Opción');
			echo('</div>');
		}

		echo('<div id="schoolZone1">');
		$this -> select2('Zona escolar', 'schoolZone', '', $schoolZone,'','TRUE','Zona escolar', 'required', 'Seleccione una Opción');
		echo('</div>');
	}

}
?>

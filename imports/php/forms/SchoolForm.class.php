<?php
class SchoolForm extends AbstractForm{

	private function exploitSchoolLevel($array) {

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione un nivel educativo'));
		foreach ($array as $schoolLevel) {

			array_push($exploit, array('value' => $schoolLevel -> getId(), 'label' => $schoolLevel->getName()));
		}
		return $exploit;
	}

	private function exploitSchoolRegion($array) {

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione una regi&oacute;n'));
		foreach ($array as $schoolRegion) {

			array_push($exploit, array('value' => $schoolRegion -> getId(), 'label' => $schoolRegion->getName()));
		}
		return $exploit;
	}

	private function exploitSchoolMode($array) {

		$schoolModeArray = array();
		foreach($array as $schoolMode){
			$schoolModeArray[$schoolMode->getMode()] = $schoolMode->getSchoolModeObject()->getName();
		}
		$schoolModeArray = array_unique($schoolModeArray);
		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione una modalidad'));
		foreach($schoolModeArray as $key => $entry){
			array_push($exploit, array('value' => $key, 'label' => $entry));
		}
		return $exploit;
	}

	private function exploitSchoolZone($array) {

		$schoolZoneArray = array();
		foreach($array as $schoolZone){
			$schoolZoneArray[$schoolZone->getId()] = $schoolZone->getZone();
		}
		$schoolZoneArray = array_unique($schoolZoneArray);
		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione una zona'));
		foreach($schoolZoneArray as $key => $entry){
			array_push($exploit, array('value' => $key, 'label' => $entry));
		}
		return $exploit;
	}

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('Name','name', '','');
		$this -> entryText('Address','address', '','');
		$this -> entryText('Suburb','suburb', '','');
		$this -> entryText('Cp','cp', '','');
		$this -> entryText('Level','level', '','');
		$this -> entryText('Sector','sector', '','');
		$this -> entryText('Zone','zone', '','');
		$this -> entryText('Schedule','schedule', '','');
		$this -> entryText('Mode','mode', '','');
		$this -> entryText('Locality','locality', '','');
		$this -> entryText('Town','town', '','');
		$this -> entryText('RegionZone','regionZone', '','');
		$this -> entryText('Region_ territory','region_ territory', '','');
		$this -> entryText('Marginalization','marginalization', '','');
		echo("</table>");
	}

	public function editForm(School $entity){

		$controller = new SchoolLevelController();
		$where = 'e.id = 2 OR e.id = 3';
		$schoolLevelList = $this -> exploitSchoolLevel($controller -> displayByAction($where));

		$where = 'e.id < 17';

		$controller = new SchoolRegionController();
		$schoolRegionList = $this -> exploitSchoolRegion($controller->displayByAction($where));

		$where = 'e.school_region = :schoolRegion AND e.level = :level';
		$whereFields = array('schoolRegion' => $entity->getRegionZone(), 'level' => $entity->getLevel());

		$controller = new SchoolRegionZoneController();
		$schoolModeList = $this -> exploitSchoolMode($controller->displayByAction($where, $whereFields));

		$where = 'e.school_region = :schoolRegion AND e.level = :level AND e.mode = :mode';
		$whereFields = array('schoolRegion' => $entity->getRegionZone(), 'level' => $entity->getLevel(), 'mode' => $entity->getMode());
		$order = 'e.zone';

		$controller = new SchoolRegionZoneController();
		$schoolZoneList = $this -> exploitSchoolZone($controller->displayByAction($where, $whereFields, '', $order));

		$this -> hidden('action', 'edit');
		$this -> hidden('id', $entity->getId());
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar Escuela :: ' . $entity->getCct());
		$this -> entryText('CCT','cct', '','CCT', $entity->getCct(), '1');
		$this -> entryText('Escuela','name', '','', $entity->getName());
		$this -> entryText('Dirección','address', '','', $entity->getAddress());
		$this -> entryText('Colonia','suburb', '','', $entity->getSuburb());
		$this -> entryText('Codigo Postal','cp', '','', $entity->getCp());
		//$this -> select2('Nivel Educativo', 'schoolLevel', '', $schoolLevelList, $entity->getLevel(), '','Cohorte');
		/*$this -> entryText('Regi&oacute;n','regionZone', '','');
		$this -> entryText('Modalidad','mode', '','');
		$this -> entryText('Zona','zone', '','');*/
		//echo('<div id="schoolRegion1">');
		//$this -> select2('Regi&oacute;n', 'schoolRegion', '', $schoolRegionList, $entity->getRegionZone(), '','Cohorte');
		//echo('</div>');

		//echo('<div id="schoolMode1">');
		//$this -> select2('Modalidad', 'schoolMode', '', $schoolModeList, $entity->getMode(), '','Modalidad');
		//echo('</div>');

		// echo('<div id="schoolZone1">');
		// $this -> select2('Zona escolar', 'schoolRegionZone', '', $schoolZoneList, $entity->getSchoolRegionZone(), '','Zona escolar');
		// echo('</div>');
	}

	public function editDataForm(School $entity){

		$schoolRegionZone = $entity->getSchoolRegionZoneObject();
		$controller = new SchoolLevelController();
		$where = 'e.id >= 1 AND e.id <= 4';
		$schoolLevelList = $this -> exploitSchoolLevel($controller -> displayByAction($where));

		$where = 'e.id != 17 AND e.id != 19';

		$controller = new SchoolRegionController();
		$schoolRegionList = $this -> exploitSchoolRegion($controller->displayByAction($where));

		$where = 'e.school_region = :schoolRegion AND e.level = :level';
		$whereFields = array('schoolRegion' => $schoolRegionZone->getSchoolRegion(), 'level' => $schoolRegionZone->getLevel());

		$controller = new SchoolRegionZoneController();
		$schoolModeList = $this -> exploitSchoolMode($controller->displayByAction($where, $whereFields));

		$where = 'e.school_region = :schoolRegion AND e.level = :level AND e.mode = :mode and e.zone < 100';
		$whereFields = array('schoolRegion' => $schoolRegionZone->getSchoolRegion(), 'level' => $schoolRegionZone->getLevel(),
			'mode' => $schoolRegionZone->getMode());

		$order = 'e.zone';

		$controller = new SchoolRegionZoneController();
		$schoolZoneList = $this -> exploitSchoolZone($controller->displayByAction($where, $whereFields, '', $order));

		$this -> hidden('action', 'editData');
		$this -> hidden('id', $entity->getId());
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar Escuela :: ' . $entity->getCct());
		$this -> select2('Nivel Educativo', 'schoolLevel', '', $schoolLevelList, $schoolRegionZone->getLevel(), '', 'Nivel Educativo');
		$this -> select2('Región', 'schoolRegion', '', $schoolRegionList, $schoolRegionZone->getSchoolRegion(), '', 'Región');
		echo('<div id="schoolMode1">');
		$this -> select2('Modalidad', 'schoolMode', '', $schoolModeList, $schoolRegionZone->getMode(), '', 'Modalidad');
		echo('</div>');
		echo('<div id="schoolZone1">');
		$this -> select2('Zona', 'schoolZone', '', $schoolZoneList, $schoolRegionZone->getZone(), '', 'Zona');
		echo('</div>');
		/*$this -> entryText('Regi&oacute;n','regionZone', '','');
		$this -> entryText('Modalidad','mode', '','');
		$this -> entryText('Zona','zone', '','');*/
		//echo('<div id="schoolRegion1">');
		//$this -> select2('Regi&oacute;n', 'schoolRegion', '', $schoolRegionList, $entity->getRegionZone(), '','Cohorte');
		//echo('</div>');

		//echo('<div id="schoolMode1">');
		//$this -> select2('Modalidad', 'schoolMode', '', $schoolModeList, $entity->getMode(), '','Modalidad');
		//echo('</div>');

		// echo('<div id="schoolZone1">');
		// $this -> select2('Zona escolar', 'schoolRegionZone', '', $schoolZoneList, $entity->getSchoolRegionZone(), '','Zona escolar');
		// echo('</div>');
	}

}
?>

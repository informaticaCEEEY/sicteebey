<?php
class SchoolRegionZoneForm extends AbstractForm{

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

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione una modalidad'));
		foreach ($array as $schoolMode) {

			array_push($exploit, array('value' => $schoolMode -> getId(), 'label' => $schoolMode->getName()));
		}
		return $exploit;
	}

	private function exploitSchoolZone() {

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione una zona'));
		for($i = 1; $i <= 86; $i++) {

			array_push($exploit, array('value' => $i, 'label' => $i));
		}
		return $exploit;
	}

	private function exploitSector() {

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione un sector'));
		for($i = 1; $i <= 9; $i++) {

			array_push($exploit, array('value' => $i, 'label' => $i));
		}
		return $exploit;
	}

	public function addForm(){

		$schoolLevelController = new SchoolLevelController();
		$where = 'e.id >= 1 AND e.id <= 4';
		$schoolLevelList = $this -> exploitSchoolLevel($schoolLevelController -> displayByAction($where));

		$schoolRegionController = new SchoolRegionController();
		$where = 'e.id != 19';
		$schoolRegionList = $this -> exploitSchoolRegion($schoolRegionController -> displayByAction($where));

		$schoolModeController = new SchoolModeController();
		$order = 'e.name';
		$schoolModeList = $this -> exploitSchoolMode($schoolModeController -> displayByAction('','','',$order));

		$schoolZoneList = $this -> exploitSchoolZone();
		$sectorList = $this -> exploitSector();

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Nueva Zona');
		$this -> select2('Nivel Educativo', 'level', '', $schoolLevelList, '', '', 'Nivel Educativo');
		$this -> select2('Modalidad', 'mode', '', $schoolModeList, '', '', 'Modalidad');
		$this -> select2('Región', 'schoolRegion', '', $schoolRegionList, '', '', 'Región');
		$this -> select2('Zona', 'zone', '', $schoolZoneList, '', '', 'Zona');
		$this -> select2('Sector', 'sector', '', $sectorList, '', '', 'Sector');
		echo("</table>");
	}

	public function editForm(SchoolRegionZone $entity){

		$schoolLevelController = new SchoolLevelController();
		$where = 'e.id >= 1 AND e.id <= 4';
		$schoolLevelList = $this -> exploitSchoolLevel($schoolLevelController -> displayByAction($where));

		$schoolRegionController = new SchoolRegionController();
		$where = 'e.id != 19';
		$schoolRegionList = $this -> exploitSchoolRegion($schoolRegionController -> displayByAction($where));

		$schoolModeController = new SchoolModeController();
		$order = 'e.name';
		$schoolModeList = $this -> exploitSchoolMode($schoolModeController -> displayByAction('','','',$order));

		$schoolZoneList = $this -> exploitSchoolZone();
		$sectorList = $this -> exploitSector();

		$this -> hidden('action', 'edit');
		$this -> hidden('idSchoolZone', $entity->getId());
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar Zona');
		$this -> select2('Nivel Educativo', 'level', '', $schoolLevelList, $entity->getLevel(), '', 'Nivel Educativo');
		$this -> select2('Modalidad', 'mode', '', $schoolModeList, $entity->getMode(), '', 'Modalidad');
		$this -> select2('Región', 'schoolRegion', '', $schoolRegionList, $entity->getSchoolRegion(), '', 'Región');
		$this -> select2('Zona', 'zone', '', $schoolZoneList, $entity->getZone(), '', 'Zona');
		$this -> select2('Sector', 'sector', '', $sectorList, $entity->getSector(), '', 'Sector');
		echo("</table>");
	}

}
?>

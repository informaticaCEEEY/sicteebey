<?php
class SchoolZoneHistorial{

	private $id;

	private $cct;

	private $schoolRegionZone;

	private $year;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}

	public function getSchoolRegionZoneObject() {

		$controller = new SchoolRegionZoneController();
		$entity = $controller -> getEntityAction($this -> schoolRegionZone);
		return $entity;
	}

	public function setId($id){

		$this->id=Validate::validateInteger($id);
	}

	public function getId(){

		return $this->id;
	}

	public function setCct($cct){

		$this->cct=$cct;
	}

	public function getCct(){

		return $this->cct;
	}

	public function setSchoolRegionZone($schoolRegionZone){

		$this->schoolRegionZone=Validate::validateInteger($schoolRegionZone);
	}

	public function getSchoolRegionZone(){

		return $this->schoolRegionZone;
	}

	public function setYear($year){

		$this->year=$year;
	}

	public function getYear(){

		return $this->year;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getCct());
		array_push($vector, $this->getSchoolRegionZone());
		array_push($vector, $this->getYear());
		return $vector;
	}
}
?>

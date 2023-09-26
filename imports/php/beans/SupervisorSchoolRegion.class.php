<?php
class SupervisorSchoolRegion{

	private $id;

	private $user;

	private $schoolRegionZone;

	private $schoolMode;

	private $schoolZone;

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

	public function setUser($user){

		$this->user=Validate::validateInteger($user);
	}

	public function getUser(){

		return $this->user;
	}

	public function setSchoolRegionZone($schoolRegionZone){

		$this->schoolRegionZone=Validate::validateInteger($schoolRegionZone);
	}

	public function getSchoolRegionZone(){

		return $this->schoolRegionZone;
	}

	public function setSchoolMode($schoolMode){

		$this->schoolMode=Validate::validateInteger($schoolMode);
	}

	public function getSchoolMode(){

		return $this->schoolMode;
	}

	public function setSchoolZone($schoolZone){

		$this->schoolZone=Validate::validateInteger($schoolZone);
	}

	public function getSchoolZone(){

		return $this->schoolZone;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getUser());
		array_push($vector, $this->getSchoolRegionZone());
		array_push($vector, $this->getSchoolMode());
		array_push($vector, $this->getSchoolZone());
		return $vector;
	}
}
?>

<?php
class SchoolRegionZone{

	private $id;

	private $schoolRegion;

	private $level;

	private $mode;

	private $zone;
    
    private $sector;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}
	
	public function getSchoolModeObject() {

		$controller = new SchoolModeController();
		$entity = $controller -> getEntityAction($this -> mode);
		return $entity;
	}
	
	public function getSchoolLevelObject() {

		$controller = new SchoolLevelController();
		$entity = $controller -> getEntityAction($this -> level);
		return $entity;
	}
	
	public function getSchoolRegionObject() {

		$controller = new SchoolRegionController();
		$entity = $controller -> getEntityAction($this -> schoolRegion);
		return $entity;
	}
	
	public function setId($id){

		$this->id=Validate::validateInteger($id);
	}

	public function getId(){

		return $this->id;
	}

	public function setSchoolRegion($schoolRegion){

		$this->schoolRegion=Validate::validateInteger($schoolRegion);
	}

	public function getSchoolRegion(){

		return $this->schoolRegion;
	}

	public function setLevel($level){

		$this->level=Validate::validateInteger($level);
	}

	public function getLevel(){

		return $this->level;
	}

	public function setMode($mode){

		$this->mode=Validate::validateInteger($mode);
	}

	public function getMode(){

		return $this->mode;
	}

	public function setZone($zone){

		$this->zone=Validate::validateInteger($zone);
	}

	public function getZone(){

		return $this->zone;
	}
    
    public function setSector($sector){

        $this->sector=Validate::validateInteger($sector);
    }

    public function getSector(){

        return $this->sector;
    }

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getSchoolRegion());
		array_push($vector, $this->getLevel());
		array_push($vector, $this->getMode());
		array_push($vector, $this->getZone());
        array_push($vector, $this->getSector());
		return $vector;
	}
}
?>
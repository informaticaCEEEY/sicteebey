<?php
class School{

	private $id;

	private $cct;

	private $name;

	private $address;

	private $suburb;

	private $cp;

	private $level;

	private $sector;

	private $zone;

	private $schedule;

	private $mode;

	private $locality;

	private $town;

  private $cdiClassification;

	private $regionZone;

	private $region_territory;

	private $marginalization;

	private $schoolRegionZone;

  private $oldSchoolRegion;

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
		$entity = $controller -> getEntityAction($this -> regionZone);
		return $entity;
	}

	public function getSchoolScheduleObject() {

		$controller = new SchoolScheduleController();
		$entity = $controller -> getEntityAction($this -> schedule);
		return $entity;
	}

	public function getSchoolRegionZoneObject() {

		$controller = new SchoolRegionZoneController();
		$entity = $controller -> getEntityAction($this -> schoolRegionZone);
		return $entity;
	}

  public function getOldSchoolRegionObject() {

    $controller = new SchoolRegionZoneController();
    $entity = $controller -> getEntityAction($this -> oldSchoolRegion);
    return $entity;
  }

  public function getSchoolMarginalizationObject() {

      $controller = new SchoolMarginalizationController();
      $entity = $controller -> getEntityAction($this -> marginalization);
      return $entity;
  }

  public function getTownObject() {

      $controller = new TownController();
      $entity = $controller -> getEntityAction($this -> town);
      return $entity;
  }

  public function getCdiClassificationObject() {

      $controller = new CdiClassificationController();
      $entity = $controller -> getEntityAction($this -> cdiClassification);
      return $entity;
  }

	public function setId($id){

		$this->id=$id;
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

	public function setName($name){

		$this->name=$name;
	}

	public function getName(){

		return $this->name;
	}

	public function setAddress($address){

		$this->address=$address;
	}

	public function getAddress(){

		return $this->address;
	}

	public function setSuburb($suburb){

		$this->suburb=$suburb;
	}

	public function getSuburb(){

		return $this->suburb;
	}

	public function setCp($cp){

		$this->cp=$cp;
	}

	public function getCp(){

		return $this->cp;
	}

	public function setLevel($level){

		$this->level=$level;
	}

	public function getLevel(){

		return $this->level;
	}

	public function setSector($sector){

		$this->sector=$sector;
	}

	public function getSector(){

		return $this->sector;
	}

	public function setZone($zone){

		$this->zone=$zone;
	}

	public function getZone(){

		return $this->zone;
	}

	public function setSchedule($schedule){

		$this->schedule=$schedule;
	}

	public function getSchedule(){

		return $this->schedule;
	}

	public function setMode($mode){

		$this->mode=$mode;
	}

	public function getMode(){

		return $this->mode;
	}

	public function setLocality($locality){

		$this->locality=$locality;
	}

	public function getLocality(){

		return $this->locality;
	}

	public function setTown($town){

		$this->town=$town;
	}

	public function getTown(){

		return $this->town;
	}

    public function setCdiClassification($cdiClassification){

        $this->cdiClassification=Validate::validateInteger($cdiClassification);
    }

    public function getCdiClassification(){

        return $this->cdiClassification;
    }

	public function setRegionZone($regionZone){

		$this->regionZone=$regionZone;
	}

	public function getRegionZone(){

		return $this->regionZone;
	}

	public function setRegion_territory($region_territory){

		$this->region_territory=$region_territory;
	}

	public function getRegion_territory(){

		return $this->region_territory;
	}

	public function setMarginalization($marginalization){

		$this->marginalization=$marginalization;
	}

	public function getMarginalization(){

		return $this->marginalization;
	}

	public function setSchoolRegionZone($schoolRegionZone){

		$this->schoolRegionZone=$schoolRegionZone;
	}

	public function getSchoolRegionZone(){

		return $this->schoolRegionZone;
	}

    public function setOldSchoolRegion($oldSchoolRegion){

        $this->oldSchoolRegion=$oldSchoolRegion;
    }

    public function getOldSchoolRegion(){

        return $this->oldSchoolRegion;
    }

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getCct());
		array_push($vector, $this->getName());
		array_push($vector, $this->getAddress());
		array_push($vector, $this->getSuburb());
		array_push($vector, $this->getCp());
		array_push($vector, $this->getLevel());
		array_push($vector, $this->getSector());
		array_push($vector, $this->getZone());
		array_push($vector, $this->getSchedule());
		array_push($vector, $this->getMode());
		array_push($vector, $this->getLocality());
		array_push($vector, $this->getTown());
        array_push($vector, $this->getCdiClassification());
		array_push($vector, $this->getRegionZone());
		array_push($vector, $this->getRegion_territory());
		array_push($vector, $this->getMarginalization());
		array_push($vector, $this->getSchoolRegionZone());
        array_push($vector, $this->getOldSchoolRegion());
		return $vector;
	}
}
?>

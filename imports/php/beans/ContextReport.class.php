<?php
class ContextReport{

	private $id;

	private $yearApplication;

	private $groupbyPeriod;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}

	public function getContextApplication() {

		$controller = new ContextApplicationController();
		$entity = $controller -> getEntityAction($this -> yearApplication);
		return $entity;
	}

	public function getGroupByPeriodObject() {

		$controller = new SchoolPeriodController();
		$entity = $controller -> getEntityAction($this -> groupbyPeriod);
		return $entity;
	}

	public function setId($id){

		$this->id=Validate::validateInteger($id);
	}

	public function getId(){

		return $this->id;
	}

	public function setYearApplication($yearApplication){

		$this->yearApplication=Validate::validateInteger($yearApplication);
	}

	public function getYearApplication(){

		return $this->yearApplication;
	}

	public function setGroupbyPeriod($groupbyPeriod){

		$this->groupbyPeriod=Validate::validateInteger($groupbyPeriod);
	}

	public function getGroupbyPeriod(){

		return $this->groupbyPeriod;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getYearApplication());
		array_push($vector, $this->getGroupbyPeriod());
		return $vector;
	}
}
?>

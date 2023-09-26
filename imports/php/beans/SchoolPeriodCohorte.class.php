<?php
class SchoolPeriodCohorte{

	private $id;

	private $schoolPeriod;

	private $cohorte;

	private $grade;

	private $schoolLevel;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}
	
	public function getSchoolPeriodObject() {

		$controller = new SchoolPeriodController();
		$entity = $controller -> getEntityAction($this -> schoolPeriod);
		return $entity;
	}
	
	public function getCohorteObject() {

		$controller = new CohorteController();
		$entity = $controller -> getEntityAction($this -> cohorte);
		return $entity;
	}
	
	public function getSchoolLevelObject() {

		$controller = new SchoolLevelController();
		$entity = $controller -> getEntityAction($this -> schoolLevel);
		return $entity;
	}
	
	public function setId($id){

		$this->id=$id;
	}

	public function getId(){

		return $this->id;
	}

	public function setSchoolPeriod($schoolPeriod){

		$this->schoolPeriod=$schoolPeriod;
	}

	public function getSchoolPeriod(){

		return $this->schoolPeriod;
	}

	public function setCohorte($cohorte){

		$this->cohorte=$cohorte;
	}

	public function getCohorte(){

		return $this->cohorte;
	}

	public function setGrade($grade){

		$this->grade=$grade;
	}

	public function getGrade(){

		return $this->grade;
	}

	public function setSchoolLevel($schoolLevel){

		$this->schoolLevel=$schoolLevel;
	}

	public function getSchoolLevel(){

		return $this->schoolLevel;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getSchoolPeriod());
		array_push($vector, $this->getCohorte());
		array_push($vector, $this->getGrade());
		array_push($vector, $this->getSchoolLevel());
		return $vector;
	}
}
?>
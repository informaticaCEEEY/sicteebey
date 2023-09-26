<?php
class Context{

	private $id;

	private $student;

	private $folio;

	private $cct;

	private $grade;

	private $schoolGroup;

	private $zone;

	private $year;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}
	public function setId($id){

		$this->id=Validate::validateInteger($id);
	}

	public function getId(){

		return $this->id;
	}

	public function setStudent($student){

		$this->student=Validate::validateInteger($student);
	}

	public function getStudent(){

		return $this->student;
	}

	public function setFolio($folio){

		$this->folio=Validate::validateInteger($folio);
	}

	public function getFolio(){

		return $this->folio;
	}

	public function setCct($cct){

		$this->cct=$cct;
	}

	public function getCct(){

		return $this->cct;
	}

	public function setGrade($grade){

		$this->grade=Validate::validateInteger($grade);
	}

	public function getGrade(){

		return $this->grade;
	}

	public function setSchoolGroup($schoolGroup){

		$this->schoolGroup=$schoolGroup;
	}

	public function getSchoolGroup(){

		return $this->schoolGroup;
	}

	public function setZone($zone){

		$this->zone=Validate::validateInteger($zone);
	}

	public function getZone(){

		return $this->zone;
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
		array_push($vector, $this->getStudent());
		array_push($vector, $this->getCct());
		array_push($vector, $this->getGrade());
		array_push($vector, $this->getSchoolGroup());
		array_push($vector, $this->getZone());
		array_push($vector, $this->getYear());
		return $vector;
	}
}
?>
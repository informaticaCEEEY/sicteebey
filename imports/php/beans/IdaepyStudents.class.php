<?php
class IdaepyStudents{

	private $id;

	private $student;

	private $folio;

	private $grade;

	private $groupSchool;

	private $cct;

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

	public function setGrade($grade){

		$this->grade=Validate::validateInteger($grade);
	}

	public function getGrade(){

		return $this->grade;
	}

	public function setSchoolGroup($schoolGroup){

		$this->schoolGroup=Validate::validateEmpty($schoolGroup);
	}

	public function getSchoolGroup(){

		return $this->schoolGroup;
	}

	public function setCct($cct){

		$this->cct=$cct;
	}

	public function getCct(){

		return $this->cct;
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
		array_push($vector, $this->getFolio());
		array_push($vector, $this->getGrade());
		array_push($vector, $this->getSchoolGroup());
		array_push($vector, $this->getCct());
		array_push($vector, $this->getYear());
		return $vector;
	}
}
?>

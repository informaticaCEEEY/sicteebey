<?php
class SchoolEnrollment{

	private $id;

	private $idStudent;

	private $startYear;

	private $cct;

	private $grade;

	private $schoolGroup;

	private $status;

	private $finalScore;

	private $idCohorte;

	private $initialCohort;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}

	public function setId($id){

		$this->id=$id;
	}

	public function getId(){

		return $this->id;
	}

	public function setIdStudent($idStudent){

		$this->idStudent=$idStudent;
	}

	public function getIdStudent(){

		return $this->idStudent;
	}

	public function setStartYear($startYear){

		$this->startYear=$startYear;
	}

	public function getStartYear(){

		return $this->startYear;
	}

	public function setCct($cct){

		$this->cct=$cct;
	}

	public function getCct(){

		return $this->cct;
	}

	public function setGrade($grade){

		$this->grade=$grade;
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

	public function setStatus($status){

		$this->status=$status;
	}

	public function getStatus(){

		return $this->status;
	}

	public function setFinalScore($finalScore){

		$this->finalScore=$finalScore;
	}

	public function getFinalScore(){

		return $this->finalScore;
	}

	public function setIdCohorte($idCohorte){

		$this->idCohorte=$idCohorte;
	}

	public function getIdCohorte(){

		return $this->idCohorte;
	}

	public function setInitialCohort($initialCohort){

		$this->initialCohort=$initialCohort;
	}

	public function getInitialCohort(){

		return $this->initialCohort;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getIdStudent());
		array_push($vector, $this->getStartYear());
		array_push($vector, $this->getCct());
		array_push($vector, $this->getGrade());
		array_push($vector, $this->getSchoolGroup());
		array_push($vector, $this->getStatus());
		array_push($vector, $this->getFinalScore());
		array_push($vector, $this->getIdCohorte());
		array_push($vector, $this->getInitialCohort());
		return $vector;
	}
}
?>
<?php
class Aprov16_17{

	private $id;

	private $idStudent;

	private $year;

	private $grade;

	private $group1;

	private $status;

	private $cct;

	private $calGlobal;

	private $reprobate;

	private $gender;

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

	public function setIdStudent($idStudent){

		$this->idStudent=Validate::validateInteger($idStudent);
	}

	public function getIdStudent(){

		return $this->idStudent;
	}

	public function setYear($year){

		$this->year=$year;
	}

	public function getYear(){

		return $this->year;
	}

	public function setGrade($grade){

		$this->grade=Validate::validateInteger($grade);
	}

	public function getGrade(){

		return $this->grade;
	}

	public function setGroup1($group1){

		$this->group1=$group1;
	}

	public function getGroup1(){

		return $this->group1;
	}

	public function setStatus($status){

		$this->status=$status;
	}

	public function getStatus(){

		return $this->status;
	}

	public function setCct($cct){

		$this->cct=Validate::validateInteger($cct);
	}

	public function getCct(){

		return $this->cct;
	}

	public function setCalGlobal($calGlobal){

		$this->calGlobal=Validate::validateEmpty($calGlobal);
	}

	public function getCalGlobal(){

		return $this->calGlobal;
	}

	public function setReprobate($reprobate){

		$this->reprobate=Validate::validateInteger($reprobate);
	}

	public function getReprobate(){

		return $this->reprobate;
	}

	public function setGender($gender){

		$this->gender=Validate::validateInteger($gender);
	}

	public function getGender(){

		return $this->gender;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getIdStudent());
		array_push($vector, $this->getYear());
		array_push($vector, $this->getGrade());
		array_push($vector, $this->getGroup1());
		array_push($vector, $this->getStatus());
		array_push($vector, $this->getCct());
		array_push($vector, $this->getCalGlobal());
		array_push($vector, $this->getReprobate());
		array_push($vector, $this->getGender());
		return $vector;
	}
}
?>
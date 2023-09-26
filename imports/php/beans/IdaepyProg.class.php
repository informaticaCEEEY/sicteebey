<?php
class IdaepyProg{

	private $id;

	private $cct;

	private $grade;

	private $groupSchool;

	private $total;

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

	public function setGroupSchool($groupSchool){

		$this->groupSchool=$groupSchool;
	}

	public function getGroupSchool(){

		return $this->groupSchool;
	}

	public function setTotal($total){

		$this->total=Validate::validateInteger($total);
	}

	public function getTotal(){

		return $this->total;
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
		array_push($vector, $this->getGrade());
		array_push($vector, $this->getGroupSchool());
		array_push($vector, $this->getTotal());
		array_push($vector, $this->getYear());
		return $vector;
	}
}
?>
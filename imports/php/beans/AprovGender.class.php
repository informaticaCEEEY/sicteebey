<?php
class AprovGender{

	private $id;

	private $cohorte;

	private $schoolPeriod;

	private $grade;

	private $totalMen;

	private $totalWomen;

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

	public function setCohorte($cohorte){

		$this->cohorte=Validate::validateInteger($cohorte);
	}

	public function getCohorte(){

		return $this->cohorte;
	}

	public function setSchoolPeriod($schoolPeriod){

		$this->schoolPeriod=Validate::validateInteger($schoolPeriod);
	}

	public function getSchoolPeriod(){

		return $this->schoolPeriod;
	}

	public function setGrade($grade){

		$this->grade=Validate::validateInteger($grade);
	}

	public function getGrade(){

		return $this->grade;
	}

	public function setTotalMen($totalMen){

		$this->totalMen=Validate::validateInteger($totalMen);
	}

	public function getTotalMen(){

		return $this->totalMen;
	}

	public function setTotalWomen($totalWomen){

		$this->totalWomen=Validate::validateInteger($totalWomen);
	}

	public function getTotalWomen(){

		return $this->totalWomen;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getCohorte());
		array_push($vector, $this->getSchoolPeriod());
		array_push($vector, $this->getGrade());
		array_push($vector, $this->getTotalMen());
		array_push($vector, $this->getTotalWomen());
		return $vector;
	}
}
?>
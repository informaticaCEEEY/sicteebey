<?php
class FactorGrade{

	private $id;

	private $factor;

	private $grade;

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

	public function setFactor($factor){

		$this->factor=Validate::validateInteger($factor);
	}

	public function getFactor(){

		return $this->factor;
	}

	public function setGrade($grade){

		$this->grade=Validate::validateInteger($grade);
	}

	public function getGrade(){

		return $this->grade;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getFactor());
		array_push($vector, $this->getGrade());
		return $vector;
	}
}
?>
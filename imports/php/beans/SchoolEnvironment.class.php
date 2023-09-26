<?php
class SchoolEnvironment{

	private $id;

	private $student;

	private $cct;

	private $R3_R3;

	private $R4_R4;

	private $R5_R5;

	private $R6_R6;

	private $R7_R7;

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

	public function setCct($cct){

		$this->cct=$cct;
	}

	public function getCct(){

		return $this->cct;
	}

	public function setR3_R3($R3_R3){

		$this->R3_R3=Validate::validateInteger($R3_R3);
	}

	public function getR3_R3(){

		return $this->R3_R3;
	}

	public function setR4_R4($R4_R4){

		$this->R4_R4=Validate::validateInteger($R4_R4);
	}

	public function getR4_R4(){

		return $this->R4_R4;
	}

	public function setR5_R5($R5_R5){

		$this->R5_R5=Validate::validateInteger($R5_R5);
	}

	public function getR5_R5(){

		return $this->R5_R5;
	}

	public function setR6_R6($R6_R6){

		$this->R6_R6=Validate::validateInteger($R6_R6);
	}

	public function getR6_R6(){

		return $this->R6_R6;
	}

	public function setR7_R7($R7_R7){

		$this->R7_R7=Validate::validateInteger($R7_R7);
	}

	public function getR7_R7(){

		return $this->R7_R7;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getStudent());
		array_push($vector, $this->getCct());
		array_push($vector, $this->getR3_R3());
		array_push($vector, $this->getR4_R4());
		array_push($vector, $this->getR5_R5());
		array_push($vector, $this->getR6_R6());
		array_push($vector, $this->getR7_R7());
		return $vector;
	}
}
?>
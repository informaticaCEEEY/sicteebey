<?php
class FamilyContext{

	private $id;

	private $student;

	private $cct;

	private $R13_R20;

	private $R14_R21;

	private $R15_R24;

	private $R16_R25;

	private $R40_R62;

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

	public function setR13_R20($R13_R20){

		$this->R13_R20=Validate::validateInteger($R13_R20);
	}

	public function getR13_R20(){

		return $this->R13_R20;
	}

	public function setR14_R21($R14_R21){

		$this->R14_R21=Validate::validateInteger($R14_R21);
	}

	public function getR14_R21(){

		return $this->R14_R21;
	}

	public function setR15_R24($R15_R24){

		$this->R15_R24=Validate::validateInteger($R15_R24);
	}

	public function getR15_R24(){

		return $this->R15_R24;
	}

	public function setR16_R25($R16_R25){

		$this->R16_R25=Validate::validateInteger($R16_R25);
	}

	public function getR16_R25(){

		return $this->R16_R25;
	}

	public function setR40_R62($R40_R62){

		$this->R40_R62=Validate::validateInteger($R40_R62);
	}

	public function getR40_R62(){

		return $this->R40_R62;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getStudent());
		array_push($vector, $this->getCct());
		array_push($vector, $this->getR13_R20());
		array_push($vector, $this->getR14_R21());
		array_push($vector, $this->getR15_R24());
		array_push($vector, $this->getR16_R25());
		array_push($vector, $this->getR40_R62());
		return $vector;
	}
}
?>
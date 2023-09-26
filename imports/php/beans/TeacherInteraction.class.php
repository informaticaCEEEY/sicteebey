<?php
class TeacherInteraction{

	private $id;

	private $student;

	private $cct;

	private $R8_R8;

	private $R9_R9;

	private $R10_R12;

	private $R11_R17;

	private $R12_R19;

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

	public function setR8_R8($R8_R8){

		$this->R8_R8=Validate::validateInteger($R8_R8);
	}

	public function getR8_R8(){

		return $this->R8_R8;
	}

	public function setR9_R9($R9_R9){

		$this->R9_R9=Validate::validateInteger($R9_R9);
	}

	public function getR9_R9(){

		return $this->R9_R9;
	}

	public function setR10_R12($R10_R12){

		$this->R10_R12=Validate::validateInteger($R10_R12);
	}

	public function getR10_R12(){

		return $this->R10_R12;
	}

	public function setR11_R17($R11_R17){

		$this->R11_R17=Validate::validateInteger($R11_R17);
	}

	public function getR11_R17(){

		return $this->R11_R17;
	}

	public function setR12_R19($R12_R19){

		$this->R12_R19=Validate::validateInteger($R12_R19);
	}

	public function getR12_R19(){

		return $this->R12_R19;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getStudent());
		array_push($vector, $this->getCct());
		array_push($vector, $this->getR8_R8());
		array_push($vector, $this->getR9_R9());
		array_push($vector, $this->getR10_R12());
		array_push($vector, $this->getR11_R17());
		array_push($vector, $this->getR12_R19());
		return $vector;
	}
}
?>
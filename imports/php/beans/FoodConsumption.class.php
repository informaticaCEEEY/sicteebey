<?php
class FoodConsumption{

	private $id;

	private $student;

	private $cct;

	private $R17_R26;

	private $R18_R27;

	private $R19_R28;

	private $R20_R29;

	private $R21_R30;

	private $R22_R31;

	private $R23_R32;

	private $R24_R33;

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

	public function setR17_R26($R17_R26){

		$this->R17_R26=Validate::validateInteger($R17_R26);
	}

	public function getR17_R26(){

		return $this->R17_R26;
	}

	public function setR18_R27($R18_R27){

		$this->R18_R27=Validate::validateInteger($R18_R27);
	}

	public function getR18_R27(){

		return $this->R18_R27;
	}

	public function setR19_R28($R19_R28){

		$this->R19_R28=Validate::validateInteger($R19_R28);
	}

	public function getR19_R28(){

		return $this->R19_R28;
	}

	public function setR20_R29($R20_R29){

		$this->R20_R29=Validate::validateInteger($R20_R29);
	}

	public function getR20_R29(){

		return $this->R20_R29;
	}

	public function setR21_R30($R21_R30){

		$this->R21_R30=Validate::validateInteger($R21_R30);
	}

	public function getR21_R30(){

		return $this->R21_R30;
	}

	public function setR22_R31($R22_R31){

		$this->R22_R31=Validate::validateInteger($R22_R31);
	}

	public function getR22_R31(){

		return $this->R22_R31;
	}

	public function setR23_R32($R23_R32){

		$this->R23_R32=Validate::validateInteger($R23_R32);
	}

	public function getR23_R32(){

		return $this->R23_R32;
	}

	public function setR24_R33($R24_R33){

		$this->R24_R33=Validate::validateInteger($R24_R33);
	}

	public function getR24_R33(){

		return $this->R24_R33;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getStudent());
		array_push($vector, $this->getCct());
		array_push($vector, $this->getR17_R26());
		array_push($vector, $this->getR18_R27());
		array_push($vector, $this->getR19_R28());
		array_push($vector, $this->getR20_R29());
		array_push($vector, $this->getR21_R30());
		array_push($vector, $this->getR22_R31());
		array_push($vector, $this->getR23_R32());
		array_push($vector, $this->getR24_R33());
		return $vector;
	}
}
?>
<?php
class DrinksConsumption{

	private $id;

	private $student;

	private $cct;

	private $R25_R34;

	private $R26_R35;

	private $R27_R36;

	private $R28_R37;

	private $R29_R38;

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

	public function setR25_R34($R25_R34){

		$this->R25_R34=Validate::validateInteger($R25_R34);
	}

	public function getR25_R34(){

		return $this->R25_R34;
	}

	public function setR26_R35($R26_R35){

		$this->R26_R35=Validate::validateInteger($R26_R35);
	}

	public function getR26_R35(){

		return $this->R26_R35;
	}

	public function setR27_R36($R27_R36){

		$this->R27_R36=Validate::validateInteger($R27_R36);
	}

	public function getR27_R36(){

		return $this->R27_R36;
	}

	public function setR28_R37($R28_R37){

		$this->R28_R37=Validate::validateInteger($R28_R37);
	}

	public function getR28_R37(){

		return $this->R28_R37;
	}

	public function setR29_R38($R29_R38){

		$this->R29_R38=Validate::validateInteger($R29_R38);
	}

	public function getR29_R38(){

		return $this->R29_R38;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getStudent());
		array_push($vector, $this->getCct());
		array_push($vector, $this->getR25_R34());
		array_push($vector, $this->getR26_R35());
		array_push($vector, $this->getR27_R36());
		array_push($vector, $this->getR28_R37());
		array_push($vector, $this->getR29_R38());
		return $vector;
	}
}
?>
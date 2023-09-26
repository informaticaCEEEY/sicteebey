<?php
class MotivationContext{

	private $id;

	private $student;

	private $folio;

	private $cct;

	private $P6O1;

	private $P6O2;

	private $P6O3;
	
	private $answered;

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

	public function setFolio($folio){

		$this->folio=$folio;
	}

	public function getFolio(){

		return $this->folio;
	}

	public function setCct($cct){

		$this->cct=$cct;
	}

	public function getCct(){

		return $this->cct;
	}

	public function setP6O1($P6O1){

		$this->P6O1=Validate::validateInteger($P6O1);
	}

	public function getP6O1(){

		return $this->P6O1;
	}

	public function setP6O2($P6O2){

		$this->P6O2=Validate::validateInteger($P6O2);
	}

	public function getP6O2(){

		return $this->P6O2;
	}

	public function setP6O3($P6O3){

		$this->P6O3=Validate::validateInteger($P6O3);
	}

	public function getP6O3(){

		return $this->P6O3;
	}
	
	public function setAnswered($answered){

		$this->answered=Validate::validateInteger($answered);
	}

	public function getAnswered(){

		return $this->answered;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getStudent());
		array_push($vector, $this->getFolio());
		array_push($vector, $this->getCct());
		array_push($vector, $this->getP6O1());
		array_push($vector, $this->getP6O2());
		array_push($vector, $this->getP6O3());
		array_push($vector, $this->getAnswered());
		return $vector;
	}
}
?>
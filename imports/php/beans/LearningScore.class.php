<?php
class LearningScore{

	private $id;

	private $student;

	private $folio;

	private $cct;

	private $P01;

	private $P02;

	private $P03;

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

	public function setP01($P01){

		$this->P01=Validate::validateInteger($P01);
	}

	public function getP01(){

		return $this->P01;
	}

	public function setP02($P02){

		$this->P02=Validate::validateInteger($P02);
	}

	public function getP02(){

		return $this->P02;
	}

	public function setP03($P03){

		$this->P03=Validate::validateInteger($P03);
	}

	public function getP03(){

		return $this->P03;
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
		array_push($vector, $this->getP01());
		array_push($vector, $this->getP02());
		array_push($vector, $this->getP03());
		array_push($vector, $this->getAnswered());
		return $vector;
	}
}
?>
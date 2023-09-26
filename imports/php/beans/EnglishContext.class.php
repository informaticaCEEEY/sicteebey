<?php
class EnglishContext{

	private $id;

	private $student;

	private $folio;

	private $cct;

	private $P14O9;

	private $P14O10;

	private $P14O11;
	
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

	public function setP14O9($P14O9){

		$this->P14O9=Validate::validateInteger($P14O9);
	}

	public function getP14O9(){

		return $this->P14O9;
	}

	public function setP14O10($P14O10){

		$this->P14O10=Validate::validateInteger($P14O10);
	}

	public function getP14O10(){

		return $this->P14O10;
	}

	public function setP14O11($P14O11){

		$this->P14O11=Validate::validateInteger($P14O11);
	}

	public function getP14O11(){

		return $this->P14O11;
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
		array_push($vector, $this->getP14O9());
		array_push($vector, $this->getP14O10());
		array_push($vector, $this->getP14O11());
		array_push($vector, $this->getAnswered());
		return $vector;
	}
}
?>
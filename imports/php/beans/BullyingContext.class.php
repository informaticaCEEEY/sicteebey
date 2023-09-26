<?php
class BullyingContext{

	private $id;

	private $student;

	private $folio;

	private $cct;

	private $P9O1;

	private $P9O2;

	private $P9O3;

	private $P9O4;
	
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

	public function setP9O1($P9O1){

		$this->P9O1=($P9O1);
	}

	public function getP9O1(){

		return $this->P9O1;
	}

	public function setP9O2($P9O2){

		$this->P9O2=Validate::validateInteger($P9O2);
	}

	public function getP9O2(){

		return $this->P9O2;
	}

	public function setP9O3($P9O3){

		$this->P9O3=Validate::validateInteger($P9O3);
	}

	public function getP9O3(){

		return $this->P9O3;
	}

	public function setP9O4($P9O4){

		$this->P9O4=Validate::validateInteger($P9O4);
	}

	public function getP9O4(){

		return $this->P9O4;
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
		array_push($vector, $this->getP9O1());
		array_push($vector, $this->getP9O2());
		array_push($vector, $this->getP9O3());
		array_push($vector, $this->getP9O4());
		array_push($vector, $this->getAnswered());
		return $vector;
	}
}
?>
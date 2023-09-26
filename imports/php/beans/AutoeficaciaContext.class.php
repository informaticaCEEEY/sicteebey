<?php
class AutoeficaciaContext{

	private $id;

	private $student;

	private $folio;

	private $cct;

	private $P8O1;

	private $P8O2;

	private $P8O3;

	private $P8O4;

	private $P8O5;
	
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

	public function setP8O1($P8O1){

		$this->P8O1=Validate::validateInteger($P8O1);
	}

	public function getP8O1(){

		return $this->P8O1;
	}

	public function setP8O2($P8O2){

		$this->P8O2=Validate::validateInteger($P8O2);
	}

	public function getP8O2(){

		return $this->P8O2;
	}

	public function setP8O3($P8O3){

		$this->P8O3=Validate::validateInteger($P8O3);
	}

	public function getP8O3(){

		return $this->P8O3;
	}

	public function setP8O4($P8O4){

		$this->P8O4=Validate::validateInteger($P8O4);
	}

	public function getP8O4(){

		return $this->P8O4;
	}

	public function setP8O5($P8O5){

		$this->P8O5=Validate::validateInteger($P8O5);
	}

	public function getP8O5(){

		return $this->P8O5;
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
		array_push($vector, $this->getP8O1());
		array_push($vector, $this->getP8O2());
		array_push($vector, $this->getP8O3());
		array_push($vector, $this->getP8O4());
		array_push($vector, $this->getP8O5());
		array_push($vector, $this->getAnswered());
		return $vector;
	}
}
?>
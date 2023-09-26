<?php
class LearningContext{

	private $id;

	private $student;

	private $folio;

	private $cct;

	private $P14O1;

	private $P14O2;

	private $P14O3;

	private $P14O4;

	private $P14O5;

	private $P14O6;

	private $P14O7;

	private $P14O8;
	
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

	public function setP14O1($P14O1){

		$this->P14O1=Validate::validateInteger($P14O1);
	}

	public function getP14O1(){

		return $this->P14O1;
	}

	public function setP14O2($P14O2){

		$this->P14O2=Validate::validateInteger($P14O2);
	}

	public function getP14O2(){

		return $this->P14O2;
	}

	public function setP14O3($P14O3){

		$this->P14O3=Validate::validateInteger($P14O3);
	}

	public function getP14O3(){

		return $this->P14O3;
	}

	public function setP14O4($P14O4){

		$this->P14O4=Validate::validateInteger($P14O4);
	}

	public function getP14O4(){

		return $this->P14O4;
	}

	public function setP14O5($P14O5){

		$this->P14O5=Validate::validateInteger($P14O5);
	}

	public function getP14O5(){

		return $this->P14O5;
	}

	public function setP14O6($P14O6){

		$this->P14O6=Validate::validateInteger($P14O6);
	}

	public function getP14O6(){

		return $this->P14O6;
	}

	public function setP14O7($P14O7){

		$this->P14O7=Validate::validateInteger($P14O7);
	}

	public function getP14O7(){

		return $this->P14O7;
	}

	public function setP14O8($P14O8){

		$this->P14O8=Validate::validateInteger($P14O8);
	}

	public function getP14O8(){

		return $this->P14O8;
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
		array_push($vector, $this->getP14O1());
		array_push($vector, $this->getP14O2());
		array_push($vector, $this->getP14O3());
		array_push($vector, $this->getP14O4());
		array_push($vector, $this->getP14O5());
		array_push($vector, $this->getP14O6());
		array_push($vector, $this->getP14O7());
		array_push($vector, $this->getP14O8());
		array_push($vector, $this->getAnswered());
		return $vector;
	}
}
?>
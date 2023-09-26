<?php
class ParentSupportContext{

	private $id;

	private $student;

	private $folio;

	private $cct;

	private $P4O1;

	private $P4O2;

	private $P4O3;

	private $P4O4;

	private $P4O5;

	private $P4O6;

	private $P4O7;

	private $P4O8;
	
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

	public function setP4O1($P4O1){

		$this->P4O1=Validate::validateInteger($P4O1);
	}

	public function getP4O1(){

		return $this->P4O1;
	}

	public function setP4O2($P4O2){

		$this->P4O2=Validate::validateInteger($P4O2);
	}

	public function getP4O2(){

		return $this->P4O2;
	}

	public function setP4O3($P4O3){

		$this->P4O3=Validate::validateInteger($P4O3);
	}

	public function getP4O3(){

		return $this->P4O3;
	}

	public function setP4O4($P4O4){

		$this->P4O4=Validate::validateInteger($P4O4);
	}

	public function getP4O4(){

		return $this->P4O4;
	}

	public function setP4O5($P4O5){

		$this->P4O5=Validate::validateInteger($P4O5);
	}

	public function getP4O5(){

		return $this->P4O5;
	}

	public function setP4O6($P4O6){

		$this->P4O6=Validate::validateInteger($P4O6);
	}

	public function getP4O6(){

		return $this->P4O6;
	}

	public function setP4O7($P4O7){

		$this->P4O7=Validate::validateInteger($P4O7);
	}

	public function getP4O7(){

		return $this->P4O7;
	}

	public function setP4O8($P4O8){

		$this->P4O8=Validate::validateInteger($P4O8);
	}

	public function getP4O8(){

		return $this->P4O8;
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
		array_push($vector, $this->getP4O1());
		array_push($vector, $this->getP4O2());
		array_push($vector, $this->getP4O3());
		array_push($vector, $this->getP4O4());
		array_push($vector, $this->getP4O5());
		array_push($vector, $this->getP4O6());
		array_push($vector, $this->getP4O7());
		array_push($vector, $this->getP4O8());
		array_push($vector, $this->getAnswered());
		return $vector;
	}
}
?>
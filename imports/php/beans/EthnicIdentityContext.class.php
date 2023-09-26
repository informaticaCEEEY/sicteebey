<?php
class EthnicIdentityContext{

	private $id;

	private $student;

	private $folio;

	private $cct;

	private $P10O1;

	private $P10O2;

	private $P10O3;

	private $P10O5;

	private $P11O5;

	private $P11O6;

	private $P11O7;
	
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

	public function setP10O1($P10O1){

		$this->P10O1=Validate::validateInteger($P10O1);
	}

	public function getP10O1(){

		return $this->P10O1;
	}

	public function setP10O2($P10O2){

		$this->P10O2=Validate::validateInteger($P10O2);
	}

	public function getP10O2(){

		return $this->P10O2;
	}

	public function setP10O3($P10O3){

		$this->P10O3=Validate::validateInteger($P10O3);
	}

	public function getP10O3(){

		return $this->P10O3;
	}

	public function setP10O5($P10O5){

		$this->P10O5=Validate::validateInteger($P10O5);
	}

	public function getP10O5(){

		return $this->P10O5;
	}

	public function setP11O5($P11O5){

		$this->P11O5=Validate::validateInteger($P11O5);
	}

	public function getP11O5(){

		return $this->P11O5;
	}

	public function setP11O6($P11O6){

		$this->P11O6=Validate::validateInteger($P11O6);
	}

	public function getP11O6(){

		return $this->P11O6;
	}

	public function setP11O7($P11O7){

		$this->P11O7=Validate::validateInteger($P11O7);
	}

	public function getP11O7(){

		return $this->P11O7;
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
		array_push($vector, $this->getP10O1());
		array_push($vector, $this->getP10O2());
		array_push($vector, $this->getP10O3());
		array_push($vector, $this->getP10O5());
		array_push($vector, $this->getP11O5());
		array_push($vector, $this->getP11O6());
		array_push($vector, $this->getP11O7());
		array_push($vector, $this->getAnswered());
		return $vector;
	}
}
?>
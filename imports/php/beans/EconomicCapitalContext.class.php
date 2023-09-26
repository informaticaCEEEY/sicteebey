<?php
class EconomicCapitalContext{

	private $id;

	private $student;

	private $folio;

	private $cct;

	private $P1O1;

	private $P1O2;

	private $P2O1;

	private $P2O2;

	private $P2O3;

	private $P2O4;

	private $P2O5;

	private $P2O6;
	
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

	public function setP1O1($P1O1){

		$this->P1O1=Validate::validateInteger($P1O1);
	}

	public function getP1O1(){

		return $this->P1O1;
	}

	public function setP1O2($P1O2){

		$this->P1O2=Validate::validateInteger($P1O2);
	}

	public function getP1O2(){

		return $this->P1O2;
	}

	public function setP2O1($P2O1){

		$this->P2O1=Validate::validateInteger($P2O1);
	}

	public function getP2O1(){

		return $this->P2O1;
	}

	public function setP2O2($P2O2){

		$this->P2O2=Validate::validateInteger($P2O2);
	}

	public function getP2O2(){

		return $this->P2O2;
	}

	public function setP2O3($P2O3){

		$this->P2O3=Validate::validateInteger($P2O3);
	}

	public function getP2O3(){

		return $this->P2O3;
	}

	public function setP2O4($P2O4){

		$this->P2O4=Validate::validateInteger($P2O4);
	}

	public function getP2O4(){

		return $this->P2O4;
	}

	public function setP2O5($P2O5){

		$this->P2O5=Validate::validateInteger($P2O5);
	}

	public function getP2O5(){

		return $this->P2O5;
	}

	public function setP2O6($P2O6){

		$this->P2O6=Validate::validateInteger($P2O6);
	}

	public function getP2O6(){

		return $this->P2O6;
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
		array_push($vector, $this->getP1O1());
		array_push($vector, $this->getP1O2());
		array_push($vector, $this->getP2O1());
		array_push($vector, $this->getP2O2());
		array_push($vector, $this->getP2O3());
		array_push($vector, $this->getP2O4());
		array_push($vector, $this->getP2O5());
		array_push($vector, $this->getP2O6());
		array_push($vector, $this->getAnswered());
		return $vector;
	}
}
?>
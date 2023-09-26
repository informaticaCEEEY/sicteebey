<?php
class TraditionsContext{

	private $id;

	private $student;

	private $folio;

	private $cct;

	private $P11O2;

	private $P11O3;

	private $P11O4;
	
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

	public function setP11O2($P11O2){

		$this->P11O2=Validate::validateInteger($P11O2);
	}

	public function getP11O2(){

		return $this->P11O2;
	}

	public function setP11O3($P11O3){

		$this->P11O3=Validate::validateInteger($P11O3);
	}

	public function getP11O3(){

		return $this->P11O3;
	}

	public function setP11O4($P11O4){

		$this->P11O4=Validate::validateInteger($P11O4);
	}

	public function getP11O4(){

		return $this->P11O4;
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
		array_push($vector, $this->getP11O2());
		array_push($vector, $this->getP11O3());
		array_push($vector, $this->getP11O4());
		array_push($vector, $this->getAnswered());
		return $vector;
	}
}
?>
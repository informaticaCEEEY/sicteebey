<?php
class StudyTechniquesContext{

	private $id;

	private $student;

	private $folio;

	private $cct;

	private $P7O1;

	private $P7O2;

	private $P7O3;

	private $P7O5;

	private $P7O4;

	private $P7O7;
	
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

	public function setP7O1($P7O1){

		$this->P7O1=Validate::validateInteger($P7O1);
	}

	public function getP7O1(){

		return $this->P7O1;
	}

	public function setP7O2($P7O2){

		$this->P7O2=Validate::validateInteger($P7O2);
	}

	public function getP7O2(){

		return $this->P7O2;
	}

	public function setP7O3($P7O3){

		$this->P7O3=Validate::validateInteger($P7O3);
	}

	public function getP7O3(){

		return $this->P7O3;
	}

	public function setP7O5($P7O5){

		$this->P7O5=Validate::validateInteger($P7O5);
	}

	public function getP7O5(){

		return $this->P7O5;
	}

	public function setP7O4($P7O4){

		$this->P7O4=Validate::validateInteger($P7O4);
	}

	public function getP7O4(){

		return $this->P7O4;
	}

	public function setP7O7($P7O7){

		$this->P7O7=Validate::validateInteger($P7O7);
	}

	public function getP7O7(){

		return $this->P7O7;
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
		array_push($vector, $this->getCct());
		array_push($vector, $this->getP7O1());
		array_push($vector, $this->getP7O2());
		array_push($vector, $this->getP7O3());
		array_push($vector, $this->getP7O5());
		array_push($vector, $this->getP7O4());
		array_push($vector, $this->getP7O7());
		array_push($vector, $this->getAnswered());
		return $vector;
	}
}
?>
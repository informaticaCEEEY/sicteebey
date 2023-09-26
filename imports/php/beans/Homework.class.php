<?php
class Homework{

	private $id;

	private $student;

	private $cct;

	private $R51_R73;

	private $R52_R74;

	private $R53_R75;

	private $R54_R76;

	private $R55_R77;

	private $R56_R78;

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

	public function setCct($cct){

		$this->cct=$cct;
	}

	public function getCct(){

		return $this->cct;
	}

	public function setR51_R73($R51_R73){

		$this->R51_R73=Validate::validateInteger($R51_R73);
	}

	public function getR51_R73(){

		return $this->R51_R73;
	}

	public function setR52_R74($R52_R74){

		$this->R52_R74=Validate::validateInteger($R52_R74);
	}

	public function getR52_R74(){

		return $this->R52_R74;
	}

	public function setR53_R75($R53_R75){

		$this->R53_R75=Validate::validateInteger($R53_R75);
	}

	public function getR53_R75(){

		return $this->R53_R75;
	}

	public function setR54_R76($R54_R76){

		$this->R54_R76=Validate::validateInteger($R54_R76);
	}

	public function getR54_R76(){

		return $this->R54_R76;
	}

	public function setR55_R77($R55_R77){

		$this->R55_R77=Validate::validateInteger($R55_R77);
	}

	public function getR55_R77(){

		return $this->R55_R77;
	}

	public function setR56_R78($R56_R78){

		$this->R56_R78=Validate::validateInteger($R56_R78);
	}

	public function getR56_R78(){

		return $this->R56_R78;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getStudent());
		array_push($vector, $this->getCct());
		array_push($vector, $this->getR51_R73());
		array_push($vector, $this->getR52_R74());
		array_push($vector, $this->getR53_R75());
		array_push($vector, $this->getR54_R76());
		array_push($vector, $this->getR55_R77());
		array_push($vector, $this->getR56_R78());
		return $vector;
	}
}
?>
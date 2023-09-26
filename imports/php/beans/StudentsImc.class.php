<?php
class StudentsImc{

	private $id;

	private $student;

	private $cct;

	private $IMC;

	private $weight;

	private $height;

	private $gender;

	private $description;

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

	public function setIMC($IMC){

		$this->IMC=$IMC;
	}

	public function getIMC(){

		return $this->IMC;
	}

	public function setWeight($weight){

		$this->weight=$weight;
	}

	public function getWeight(){

		return $this->weight;
	}

	public function setHeight($height){

		$this->height=$height;
	}

	public function getHeight(){

		return $this->height;
	}

	public function setGender($gender){

		$this->gender=Validate::validateInteger($gender);
	}

	public function getGender(){

		return $this->gender;
	}

	public function setDescription($description){

		$this->description=Validate::validateInteger($description);
	}

	public function getDescription(){

		return $this->description;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getStudent());
		array_push($vector, $this->getCct());
		array_push($vector, $this->getIMC());
		array_push($vector, $this->getWeight());
		array_push($vector, $this->getHeight());
		array_push($vector, $this->getGender());
		array_push($vector, $this->getDescription());
		return $vector;
	}
}
?>
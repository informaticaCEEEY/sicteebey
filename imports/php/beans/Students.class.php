<?php
class Students{

	private $id;

	private $lastName;

	private $secondName;

	private $name;

	private $curp;

	private $gender;

	private $birthDate;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}
	public function setId($id){

		$this->id=$id;
	}

	public function getId(){

		return $this->id;
	}

	public function setLastName($lastName){

		$this->lastName=$lastName;
	}

	public function getLastName(){

		return $this->lastName;
	}

	public function setSecondName($secondName){

		$this->secondName=$secondName;
	}

	public function getSecondName(){

		return $this->secondName;
	}

	public function setName($name){

		$this->name=$name;
	}

	public function getName(){

		return $this->name;
	}

	public function setCurp($curp){

		$this->curp=$curp;
	}

	public function getCurp(){

		return $this->curp;
	}

	public function setGender($gender){

		$this->gender=$gender;
	}

	public function getGender(){

		return $this->gender;
	}

	public function setBirthDate($birthDate){

		$this->birthDate=$birthDate;
	}

	public function getBirthDate(){

		return $this->birthDate;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getLastName());
		array_push($vector, $this->getSecondName());
		array_push($vector, $this->getName());
		array_push($vector, $this->getCurp());
		array_push($vector, $this->getGender());
		array_push($vector, $this->getBirthDate());
		return $vector;
	}
}
?>
<?php
class UserType{

	private $id;

	private $name;

	private $abbreviation;

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

	public function setName($name){

		$this->name=Validate::validateEmpty($name);
	}

	public function getName(){

		return $this->name;
	}

	public function setAbbreviation($abbreviation){

		$this->abbreviation=$abbreviation;
	}

	public function getAbbreviation(){

		return $this->abbreviation;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getName());
		array_push($vector, $this->getAbbreviation());
		return $vector;
	}
}
?>

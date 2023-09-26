<?php
class SchoolMarginalization{

	private $id;

	private $name;

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

	public function setName($name){

		$this->name=$name;
	}

	public function getName(){

		return $this->name;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getName());
		return $vector;
	}
}
?>
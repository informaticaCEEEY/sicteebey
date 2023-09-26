<?php
class Subject{

	private $id;

	private $name;

	private $alias;

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

		$this->name=$name;
	}

	public function getName(){

		return $this->name;
	}

	public function setAlias($alias){

		$this->alias=$alias;
	}

	public function getAlias(){

		return $this->alias;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getName());
		array_push($vector, $this->getAlias());
		return $vector;
	}
}
?>

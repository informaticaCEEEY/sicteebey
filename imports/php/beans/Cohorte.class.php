<?php
class Cohorte{

	private $id;

	private $name;

	private $tableCohorte;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}
	
	function __toString(){
		
		return 'Cohorte ' . $this->name;
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

	public function setTableCohorte($tableCohorte){

		$this->tableCohorte=$tableCohorte;
	}

	public function getTableCohorte(){

		return $this->tableCohorte;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getName());
		array_push($vector, $this->getTableCohorte());
		return $vector;
	}
}
?>
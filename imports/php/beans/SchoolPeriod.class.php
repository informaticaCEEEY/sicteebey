<?php
class SchoolPeriod{

	private $id;

	private $name;

	private $tablePeriod;

	private $startYear;

	private $endYear;

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

	public function setTablePeriod($tablePeriod){

		$this->tablePeriod=$tablePeriod;
	}

	public function getTablePeriod(){

		return $this->tablePeriod;
	}

	public function setStartYear($startYear){

		$this->startYear=$startYear;
	}

	public function getStartYear(){

		return $this->startYear;
	}

	public function setEndYear($endYear){

		$this->endYear=$endYear;
	}

	public function getEndYear(){

		return $this->endYear;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getName());
		array_push($vector, $this->getTablePeriod());
		array_push($vector, $this->getStartYear());
		array_push($vector, $this->getEndYear());
		return $vector;
	}
}
?>

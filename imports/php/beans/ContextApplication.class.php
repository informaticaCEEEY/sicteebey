<?php
class ContextApplication{

	private $id;

	private $yearApplication;

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

	public function setYearApplication($yearApplication){

		$this->yearApplication=$yearApplication;
	}

	public function getYearApplication(){

		return $this->yearApplication;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getYearApplication());
		return $vector;
	}
}
?>

<?php
class VisitorCounter{

	private $id;

	private $visitDate;

	private $ipAddress;

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

	public function setVisitDate($visitDate){

		$this->visitDate=Validate::validateEmpty($visitDate);
	}

	public function getVisitDate(){

		return $this->visitDate;
	}

	public function setIpAddress($ipAddress){

		$this->ipAddress=$ipAddress;
	}

	public function getIpAddress(){

		return $this->ipAddress;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getVisitDate());
		array_push($vector, $this->getIpAddress());
		return $vector;
	}
}
?>
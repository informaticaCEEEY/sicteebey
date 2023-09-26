<?php
class AprovModeSecu{

	private $id;

	private $cohorte;

	private $schoolPeriod;

	private $mode;

	private $total;

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

	public function setCohorte($cohorte){

		$this->cohorte=Validate::validateInteger($cohorte);
	}

	public function getCohorte(){

		return $this->cohorte;
	}

	public function setSchoolPeriod($schoolPeriod){

		$this->schoolPeriod=Validate::validateInteger($schoolPeriod);
	}

	public function getSchoolPeriod(){

		return $this->schoolPeriod;
	}

	public function setMode($mode){

		$this->mode=Validate::validateInteger($mode);
	}

	public function getMode(){

		return $this->mode;
	}

	public function setTotal($total){

		$this->total=Validate::validateInteger($total);
	}

	public function getTotal(){

		return $this->total;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getCohorte());
		array_push($vector, $this->getSchoolPeriod());
		array_push($vector, $this->getMode());
		array_push($vector, $this->getTotal());
		return $vector;
	}
}
?>
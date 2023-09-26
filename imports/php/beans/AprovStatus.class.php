<?php
class AprovStatus{

	private $id;

	private $cohorte;

	private $schoolPeriod;

	private $statusA;

	private $statusR;

	private $statusX;

	private $statusZ;
    
    private $unregisteredThree;

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

	public function setStatusA($statusA){

		$this->statusA=Validate::validateInteger($statusA);
	}

	public function getStatusA(){

		return $this->statusA;
	}

	public function setStatusR($statusR){

		$this->statusR=Validate::validateInteger($statusR);
	}

	public function getStatusR(){

		return $this->statusR;
	}

	public function setStatusX($statusX){

		$this->statusX=Validate::validateInteger($statusX);
	}

	public function getStatusX(){

		return $this->statusX;
	}

	public function setStatusZ($statusZ){

		$this->statusZ=Validate::validateInteger($statusZ);
	}

	public function getStatusZ(){

		return $this->statusZ;
	}
    
    public function setUnregisteredThree($unregisteredThree){

        $this->unregisteredThree=Validate::validateInteger($unregisteredThree);
    }

    public function getUnregisteredThree(){

        return $this->unregisteredThree;
    }

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getCohorte());
		array_push($vector, $this->getSchoolPeriod());
		array_push($vector, $this->getStatusA());
		array_push($vector, $this->getStatusR());
		array_push($vector, $this->getStatusX());
		array_push($vector, $this->getStatusZ());
        array_push($vector, $this->getUnregisteredThree());
		return $vector;
	}
}
?>
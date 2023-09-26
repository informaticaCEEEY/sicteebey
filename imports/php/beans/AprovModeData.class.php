<?php
class AprovModeData{

	private $id;

	private $cohorte;

	private $schoolPeriod;

	private $mode;

	private $total;

	private $newStudents;

	private $studentsLeaving;

	private $totalIdeal;

	private $newStudentsIdeal;

	private $studentsIdealLeaving;

	private $slightLag;

	private $seriousLag;

	private $unregistered;
    
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

	public function setNewStudents($newStudents){

		$this->newStudents=Validate::validateInteger($newStudents);
	}

	public function getNewStudents(){

		return $this->newStudents;
	}

	public function setStudentsLeaving($studentsLeaving){

		$this->studentsLeaving=Validate::validateInteger($studentsLeaving);
	}

	public function getStudentsLeaving(){

		return $this->studentsLeaving;
	}

	public function setTotalIdeal($totalIdeal){

		$this->totalIdeal=Validate::validateInteger($totalIdeal);
	}

	public function getTotalIdeal(){

		return $this->totalIdeal;
	}

	public function setNewStudentsIdeal($newStudentsIdeal){

		$this->newStudentsIdeal=Validate::validateInteger($newStudentsIdeal);
	}

	public function getNewStudentsIdeal(){

		return $this->newStudentsIdeal;
	}

	public function setStudentsIdealLeaving($studentsIdealLeaving){

		$this->studentsIdealLeaving=Validate::validateInteger($studentsIdealLeaving);
	}

	public function getStudentsIdealLeaving(){

		return $this->studentsIdealLeaving;
	}

	public function setSlightLag($slightLag){

		$this->slightLag=Validate::validateInteger($slightLag);
	}

	public function getSlightLag(){

		return $this->slightLag;
	}

	public function setSeriousLag($seriousLag){

		$this->seriousLag=Validate::validateInteger($seriousLag);
	}

	public function getSeriousLag(){

		return $this->seriousLag;
	}

	public function setUnregistered($unregistered){

		$this->unregistered=Validate::validateInteger($unregistered);
	}

	public function getUnregistered(){

		return $this->unregistered;
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
		array_push($vector, $this->getMode());
		array_push($vector, $this->getTotal());
		array_push($vector, $this->getNewStudents());
		array_push($vector, $this->getStudentsLeaving());
		array_push($vector, $this->getTotalIdeal());
		array_push($vector, $this->getNewStudentsIdeal());
		array_push($vector, $this->getStudentsIdealLeaving());
		array_push($vector, $this->getSlightLag());
		array_push($vector, $this->getSeriousLag());
		array_push($vector, $this->getUnregistered());
        array_push($vector, $this->getUnregisteredThree());
		return $vector;
	}
}
?>
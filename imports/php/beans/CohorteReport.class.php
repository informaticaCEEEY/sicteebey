<?php
class CohorteReport{

	private $cohorte;

	private $totalStudents;

	private $schoolPeriod;

	private $enrolledStudents;

	private $totalIdealDegree;

	private $slightLag;

	private $seriousLag;

	private $unregistered;

	private $unregisteredThree;

	private $graduates;

	private $enrolledNextGrade;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}
	
	public function getSchoolPeriodObject() {

		$controller = new SchoolPeriodController();
		$entity = $controller -> getEntityAction($this -> schoolPeriod);
		return $entity;
	}
	
	public function getCohorteObject() {

		$controller = new CohorteController();
		$entity = $controller -> getEntityAction($this -> cohorte);
		return $entity;
	}
	
	public function setCohorte($cohorte){

		$this->cohorte=Validate::validateInteger($cohorte);
	}

	public function getCohorte(){

		return $this->cohorte;
	}

	public function setTotalStudents($totalStudents){

		$this->totalStudents=Validate::validateInteger($totalStudents);
	}

	public function getTotalStudents(){

		return $this->totalStudents;
	}

	public function setSchoolPeriod($schoolPeriod){

		$this->schoolPeriod=Validate::validateInteger($schoolPeriod);
	}

	public function getSchoolPeriod(){

		return $this->schoolPeriod;
	}

	public function setEnrolledStudents($enrolledStudents){

		$this->enrolledStudents=Validate::validateInteger($enrolledStudents);
	}

	public function getEnrolledStudents(){

		return $this->enrolledStudents;
	}

	public function setTotalIdealDegree($totalIdealDegree){

		$this->totalIdealDegree=Validate::validateInteger($totalIdealDegree);
	}

	public function getTotalIdealDegree(){

		return $this->totalIdealDegree;
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

	public function setGraduates($graduates){

		$this->graduates=Validate::validateInteger($graduates);
	}

	public function getGraduates(){

		return $this->graduates;
	}

	public function setEnrolledNextGrade($enrolledNextGrade){

		$this->enrolledNextGrade=Validate::validateInteger($enrolledNextGrade);
	}

	public function getEnrolledNextGrade(){

		return $this->enrolledNextGrade;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getCohorte());
		array_push($vector, $this->getTotalStudents());
		array_push($vector, $this->getSchoolPeriod());
		array_push($vector, $this->getEnrolledStudents());
		array_push($vector, $this->getTotalIdealDegree());
		array_push($vector, $this->getSlightLag());
		array_push($vector, $this->getSeriousLag());
		array_push($vector, $this->getUnregistered());
		array_push($vector, $this->getUnregisteredThree());
		array_push($vector, $this->getGraduates());
		array_push($vector, $this->getEnrolledNextGrade());
		return $vector;
	}
}
?>
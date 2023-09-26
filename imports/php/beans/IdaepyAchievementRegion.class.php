<?php
class IdaepyAchievementRegion{

	private $id;

	private $schoolRegion;

	private $subject;

	private $achievement;

	private $total;

	private $percentage;

	private $year;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}

	public function getAchievementObject() {

		$controller = new AchievementController();
		$entity = $controller -> getEntityAction($this -> achievement);
		return $entity;
	}

	public function getSubjectObject() {

		$controller = new SubjectController();
		$entity = $controller -> getEntityAction($this -> subject);
		return $entity;
	}

	public function setId($id){

		$this->id=Validate::validateInteger($id);
	}

	public function getId(){

		return $this->id;
	}

	public function setSchoolRegion($schoolRegion){

		$this->schoolRegion=Validate::validateInteger($schoolRegion);
	}

	public function getSchoolRegion(){

		return $this->schoolRegion;
	}

	public function setSubject($subject){

		$this->subject=Validate::validateInteger($subject);
	}

	public function getSubject(){

		return $this->subject;
	}

	public function setAchievement($achievement){

		$this->achievement=Validate::validateInteger($achievement);
	}

	public function getAchievement(){

		return $this->achievement;
	}

	public function setTotal($total){

		$this->total=$total;
	}

	public function getTotal(){

		return $this->total;
	}

	public function setPercentage($percentage){

		$this->percentage=$percentage;
	}

	public function getPercentage(){

		return $this->percentage;
	}

	public function setYear($year){

		$this->year=$year;
	}

	public function getYear(){

		return $this->year;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getSchoolRegion());
		array_push($vector, $this->getSubject());
		array_push($vector, $this->getAchievement());
		array_push($vector, $this->getTotal());
		array_push($vector, $this->getPercentage());
		array_push($vector, $this->getYear());
		return $vector;
	}
}
?>

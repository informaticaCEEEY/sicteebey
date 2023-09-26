<?php
class AchievementIdaepy{

	private $id;

	private $achievement;

	private $year;

	private $orderNumber;

	private $codeR;

	private $codeG;

	private $codeB;

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

	public function setAchievement($achievement){

		$this->achievement=Validate::validateInteger($achievement);
	}

	public function getAchievement(){

		return $this->achievement;
	}

	public function setYear($year){

		$this->year=$year;
	}

	public function getYear(){

		return $this->year;
	}

	public function setOrderNumber($orderNumber){

		$this->orderNumber=Validate::validateInteger($orderNumber);
	}

	public function getOrderNumber(){

		return $this->orderNumber;
	}

	public function setCodeR($codeR){

		$this->codeR=Validate::validateInteger($codeR);
	}

	public function getCodeR(){

		return $this->codeR;
	}

	public function setCodeG($codeG){

		$this->codeG=Validate::validateInteger($codeG);
	}

	public function getCodeG(){

		return $this->codeG;
	}

	public function setCodeB($codeB){

		$this->codeB=Validate::validateInteger($codeB);
	}

	public function getCodeB(){

		return $this->codeB;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getAchievement());
		array_push($vector, $this->getYear());
		array_push($vector, $this->getOrderNumber());
		array_push($vector, $this->getCodeR());
		array_push($vector, $this->getCodeG());
		array_push($vector, $this->getCodeB());
		return $vector;
	}
}
?>

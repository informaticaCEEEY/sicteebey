<?php
class IdaepyPercentageRegion{

	private $id;

	private $schoolRegion;

	private $subject;

	private $percentage;

	private $evaluated;

	private $year;

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

	public function setPercentage($percentage){

		$this->percentage=$percentage;
	}

	public function getPercentage(){

		return $this->percentage;
	}

	public function setEvaluated($evaluated){

		$this->evaluated=Validate::validateInteger($evaluated);
	}

	public function getEvaluated(){

		return $this->evaluated;
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
		array_push($vector, $this->getPercentage());
		array_push($vector, $this->getEvaluated());
		array_push($vector, $this->getYear());
		return $vector;
	}
}
?>
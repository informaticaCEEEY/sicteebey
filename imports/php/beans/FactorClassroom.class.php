<?php
class FactorClassroom{

	private $id;

	private $cct;

	private $schedule;

	private $grade;

	private $schoolGroup;

	private $factor;

	private $media;

	private $total;
    
    private $year;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}
	
	public function getFactorObject() {

		$controller = new FactorController();
		$entity = $controller -> getEntityAction($this -> factor);
		return $entity;
	}
	
	public function setId($id){

		$this->id=Validate::validateInteger($id);
	}

	public function getId(){

		return $this->id;
	}

	public function setCct($cct){

		$this->cct=$cct;
	}

	public function getCct(){

		return $this->cct;
	}

	public function setSchedule($schedule){

		$this->schedule=Validate::validateInteger($schedule);
	}

	public function getSchedule(){

		return $this->schedule;
	}

	public function setGrade($grade){

		$this->grade=Validate::validateInteger($grade);
	}

	public function getGrade(){

		return $this->grade;
	}

	public function setSchoolGroup($schoolGroup){

		$this->schoolGroup=$schoolGroup;
	}

	public function getSchoolGroup(){

		return $this->schoolGroup;
	}

	public function setFactor($factor){

		$this->factor=Validate::validateInteger($factor);
	}

	public function getFactor(){

		return $this->factor;
	}

	public function setMedia($media){

		$this->media=$media;
	}

	public function getMedia(){

		return $this->media;
	}

	public function setTotal($total){

		$this->total=Validate::validateInteger($total);
	}

	public function getTotal(){

		return $this->total;
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
		array_push($vector, $this->getCct());
		array_push($vector, $this->getSchedule());
		array_push($vector, $this->getGrade());
		array_push($vector, $this->getSchoolGroup());
		array_push($vector, $this->getFactor());
		array_push($vector, $this->getMedia());
		array_push($vector, $this->getTotal());
        array_push($vector, $this->getYear());
		return $vector;
	}
}
?>
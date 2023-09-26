<?php
class IdaepyAchievement{

	private $id;

	private $student;
    
    private $percentageHits;

	private $percentageMath;

	private $percentageScience;

	private $percentageSpanish;

	private $achievementMath;

	private $achievementScience;

	private $achievementSpanish;

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

	public function setStudent($student){

		$this->student=Validate::validateInteger($student);
	}

	public function getStudent(){

		return $this->student;
	}
    
    public function setPercentageHits($percentageHits){

        $this->percentageHits=$percentageHits;
    }

    public function getPercentageHits(){

        return $this->percentageHits;
    }

	public function setPercentageMath($percentageMath){

		$this->percentageMath=$percentageMath;
	}

	public function getPercentageMath(){

		return $this->percentageMath;
	}

	public function setPercentageScience($percentageScience){

		$this->percentageScience=$percentageScience;
	}

	public function getPercentageScience(){

		return $this->percentageScience;
	}

	public function setPercentageSpanish($percentageSpanish){

		$this->percentageSpanish=$percentageSpanish;
	}

	public function getPercentageSpanish(){

		return $this->percentageSpanish;
	}

	public function setAchievementMath($achievementMath){

		$this->achievementMath=Validate::validateInteger($achievementMath);
	}

	public function getAchievementMath(){

		return $this->achievementMath;
	}

	public function setAchievementScience($achievementScience){

		$this->achievementScience=Validate::validateInteger($achievementScience);
	}

	public function getAchievementScience(){

		return $this->achievementScience;
	}

	public function setAchievementSpanish($achievementSpanish){

		$this->achievementSpanish=Validate::validateInteger($achievementSpanish);
	}

	public function getAchievementSpanish(){

		return $this->achievementSpanish;
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
		array_push($vector, $this->getStudent());
        array_push($vector, $this->getPercentageHits());
		array_push($vector, $this->getPercentageMath());
		array_push($vector, $this->getPercentageScience());
		array_push($vector, $this->getPercentageSpanish());
		array_push($vector, $this->getAchievementMath());
		array_push($vector, $this->getAchievementScience());
		array_push($vector, $this->getAchievementSpanish());
		array_push($vector, $this->getYear());
		return $vector;
	}
}
?>
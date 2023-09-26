<?php
class IdaepyAchievementRegionZone{

	private $id;

	private $schoolRegionZone;

	private $evaluated;

	private $hitsPercentage;

	private $mathPercentage;

	private $sciencePercentage;

	private $spanishPercentage;

	private $mathAchievementBasic;

	private $mathAchievementMedium;

	private $mathAchievementAdvanced;

	private $spanishAchievementBasic;

	private $spanishAchievementMedium;

	private $spanishAchievementAdvanced;

	private $scienceAchievementBasic;

	private $scienceAchievementMedium;

	private $scienceAchievementAdvanced;

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

	public function setSchoolRegionZone($schoolRegionZone){

		$this->schoolRegionZone=Validate::validateInteger($schoolRegionZone);
	}

	public function getSchoolRegionZone(){

		return $this->schoolRegionZone;
	}

	public function setEvaluated($evaluated){

		$this->evaluated=Validate::validateInteger($evaluated);
	}

	public function getEvaluated(){

		return $this->evaluated;
	}

	public function setHitsPercentage($hitsPercentage){

		$this->hitsPercentage=$hitsPercentage;
	}

	public function getHitsPercentage(){

		return $this->hitsPercentage;
	}

	public function setMathPercentage($mathPercentage){

		$this->mathPercentage=$mathPercentage;
	}

	public function getMathPercentage(){

		return $this->mathPercentage;
	}

	public function setSciencePercentage($sciencePercentage){

		$this->sciencePercentage=$sciencePercentage;
	}

	public function getSciencePercentage(){

		return $this->sciencePercentage;
	}

	public function setSpanishPercentage($spanishPercentage){

		$this->spanishPercentage=$spanishPercentage;
	}

	public function getSpanishPercentage(){

		return $this->spanishPercentage;
	}

	public function setMathAchievementBasic($mathAchievementBasic){

		$this->mathAchievementBasic=$mathAchievementBasic;
	}

	public function getMathAchievementBasic(){

		return $this->mathAchievementBasic;
	}

	public function setMathAchievementMedium($mathAchievementMedium){

		$this->mathAchievementMedium=$mathAchievementMedium;
	}

	public function getMathAchievementMedium(){

		return $this->mathAchievementMedium;
	}

	public function setMathAchievementAdvanced($mathAchievementAdvanced){

		$this->mathAchievementAdvanced=$mathAchievementAdvanced;
	}

	public function getMathAchievementAdvanced(){

		return $this->mathAchievementAdvanced;
	}

	public function setSpanishAchievementBasic($spanishAchievementBasic){

		$this->spanishAchievementBasic=$spanishAchievementBasic;
	}

	public function getSpanishAchievementBasic(){

		return $this->spanishAchievementBasic;
	}

	public function setSpanishAchievementMedium($spanishAchievementMedium){

		$this->spanishAchievementMedium=$spanishAchievementMedium;
	}

	public function getSpanishAchievementMedium(){

		return $this->spanishAchievementMedium;
	}

	public function setSpanishAchievementAdvanced($spanishAchievementAdvanced){

		$this->spanishAchievementAdvanced=$spanishAchievementAdvanced;
	}

	public function getSpanishAchievementAdvanced(){

		return $this->spanishAchievementAdvanced;
	}

	public function setScienceAchievementBasic($scienceAchievementBasic){

		$this->scienceAchievementBasic=$scienceAchievementBasic;
	}

	public function getScienceAchievementBasic(){

		return $this->scienceAchievementBasic;
	}

	public function setScienceAchievementMedium($scienceAchievementMedium){

		$this->scienceAchievementMedium=$scienceAchievementMedium;
	}

	public function getScienceAchievementMedium(){

		return $this->scienceAchievementMedium;
	}

	public function setScienceAchievementAdvanced($scienceAchievementAdvanced){

		$this->scienceAchievementAdvanced=$scienceAchievementAdvanced;
	}

	public function getScienceAchievementAdvanced(){

		return $this->scienceAchievementAdvanced;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getSchoolRegionZone());
		array_push($vector, $this->getEvaluated());
		array_push($vector, $this->getHitsPercentage());
		array_push($vector, $this->getMathPercentage());
		array_push($vector, $this->getSciencePercentage());
		array_push($vector, $this->getSpanishPercentage());
		array_push($vector, $this->getMathAchievementBasic());
		array_push($vector, $this->getMathAchievementMedium());
		array_push($vector, $this->getMathAchievementAdvanced());
		array_push($vector, $this->getSpanishAchievementBasic());
		array_push($vector, $this->getSpanishAchievementMedium());
		array_push($vector, $this->getSpanishAchievementAdvanced());
		array_push($vector, $this->getScienceAchievementBasic());
		array_push($vector, $this->getScienceAchievementMedium());
		array_push($vector, $this->getScienceAchievementAdvanced());
		return $vector;
	}
}
?>
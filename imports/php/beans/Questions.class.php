<?php
class Questions{

	private $id;

	private $title;

	private $factor;

	private $questionNumber;

	private $chart;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}

	public function getChartObject() {

		$controller = new ChartController();
		$entity = $controller -> getEntityAction($this -> chart);
		return $entity;
	}

	public function setId($id){

		$this->id=Validate::validateInteger($id);
	}

	public function getId(){

		return $this->id;
	}

	public function setTitle($title){

		$this->title=Validate::validateEmpty($title);
	}

	public function getTitle(){

		return $this->title;
	}

	public function setFactor($factor){

		$this->factor=Validate::validateInteger($factor);
	}

	public function getFactor(){

		return $this->factor;
	}

	public function setQuestionNumber($questionNumber){

		$this->questionNumber=Validate::validateInteger($questionNumber);
	}

	public function getQuestionNumber(){

		return $this->questionNumber;
	}

	public function setChart($chart){

		$this->chart=Validate::validateInteger($chart);
	}

	public function getChart(){

		return $this->chart;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getTitle());
		array_push($vector, $this->getFactor());
		array_push($vector, $this->getQuestionNumber());
		array_push($vector, $this->getChart());
		return $vector;
	}
}
?>

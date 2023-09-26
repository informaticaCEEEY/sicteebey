<?php
class ContextResults{

	private $id;

	private $factor;

	private $question;

	private $answer;

	private $total;

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

	public function setFactor($factor){

		$this->factor=Validate::validateInteger($factor);
	}

	public function getFactor(){

		return $this->factor;
	}

	public function setQuestion($question){

		$this->question=Validate::validateInteger($question);
	}

	public function getQuestion(){

		return $this->question;
	}

	public function setAnswer($answer){

		$this->answer=Validate::validateInteger($answer);
	}

	public function getAnswer(){

		return $this->answer;
	}

	public function setTotal($total){

		$this->total=Validate::validateInteger($total);
	}

	public function getTotal(){

		return $this->total;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getFactor());
		array_push($vector, $this->getQuestion());
		array_push($vector, $this->getAnswer());
		array_push($vector, $this->getTotal());
		return $vector;
	}
}
?>
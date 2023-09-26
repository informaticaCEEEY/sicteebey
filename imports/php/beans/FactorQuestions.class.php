<?php
class FactorQuestions{

	private $id;

	private $factor;

	private $question;

	private $questionNumber;

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

		$this->question=Validate::validateEmpty($question);
	}

	public function getQuestion(){

		return $this->question;
	}

	public function setQuestionNumber($questionNumber){

		$this->questionNumber=Validate::validateInteger($questionNumber);
	}

	public function getQuestionNumber(){

		return $this->questionNumber;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getFactor());
		array_push($vector, $this->getQuestion());
		array_push($vector, $this->getQuestionNumber());
		return $vector;
	}
}
?>
<?php
class QuestionsContext{

	private $id;

	private $folio;

	private $cct;

	private $question;

	private $answer;

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

	public function setFolio($folio){

		$this->folio=Validate::validateInteger($folio);
	}

	public function getFolio(){

		return $this->folio;
	}

	public function setCct($cct){

		$this->cct=$cct;
	}

	public function getCct(){

		return $this->cct;
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

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getFolio());
		array_push($vector, $this->getCct());
		array_push($vector, $this->getQuestion());
		array_push($vector, $this->getAnswer());
		return $vector;
	}
}
?>
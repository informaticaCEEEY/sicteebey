<?php
class QuestionGrade{

	private $id;

	private $question;

	private $grade;

	private $enabled;

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

	public function setQuestion($question){

		$this->question=Validate::validateInteger($question);
	}

	public function getQuestion(){

		return $this->question;
	}

	public function setGrade($grade){

		$this->grade=Validate::validateInteger($grade);
	}

	public function getGrade(){

		return $this->grade;
	}

	public function setEnabled($enabled){

		$this->enabled=Validate::validateInteger($enabled);
	}

	public function getEnabled(){

		return $this->enabled;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getQuestion());
		array_push($vector, $this->getGrade());
		array_push($vector, $this->getEnabled());
		return $vector;
	}
}
?>
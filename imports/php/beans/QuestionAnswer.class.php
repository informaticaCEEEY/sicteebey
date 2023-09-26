<?php
class QuestionAnswer{

	private $id;

	private $question;

	private $answer;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}
    
    public function getQuestionObject() {

        $controller = new QuestionsController();
        $entity = $controller -> getEntityAction($this -> question);
        return $entity;
    }
    
    public function getAnswerObject() {

        $controller = new AnswersController();
        $entity = $controller -> getEntityAction($this -> answer);
        return $entity;
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

	public function setAnswer($answer){

		$this->answer=Validate::validateInteger($answer);
	}

	public function getAnswer(){

		return $this->answer;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getQuestion());
		array_push($vector, $this->getAnswer());
		return $vector;
	}
}
?>
<?php
class FactorQuestionsDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('factor_questions', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new FactorQuestions(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setFactor(gosSanitizer::sanitizeForHTMLContent($factor));
			$object->setQuestion(gosSanitizer::sanitizeForHTMLContent($question));
			$object->setQuestionNumber(gosSanitizer::sanitizeForHTMLContent($question_number));
			return $object;
		}else{
			return null;
		}
	}

	public function getEntity($id){

		$objects = $this -> getBy($this -> keyValue, $id);
		if(count($objects)==1){

			return $objects[0];
		}else{
			return null;
		}
	}

	public function add(FactorQuestions $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(FactorQuestions $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(FactorQuestions $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

	public function listObjects2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields){

		return $this -> listAll2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields);
	}

}
?>
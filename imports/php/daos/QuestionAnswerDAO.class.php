<?php
class QuestionAnswerDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('question_answer', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new QuestionAnswer(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setQuestion(gosSanitizer::sanitizeForHTMLContent($question));
			$object->setAnswer(gosSanitizer::sanitizeForHTMLContent($answer));
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

	public function add(QuestionAnswer $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(QuestionAnswer $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(QuestionAnswer $entity=null){

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
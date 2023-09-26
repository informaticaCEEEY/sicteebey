<?php
class QuestionsDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('questions', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new Questions(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setTitle(($title));
			$object->setFactor(gosSanitizer::sanitizeForHTMLContent($factor));
			$object->setQuestionNumber(gosSanitizer::sanitizeForHTMLContent($question_number));
			$object->setChart(gosSanitizer::sanitizeForHTMLContent($chart));
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

	public function add(Questions $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(Questions $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(Questions $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>

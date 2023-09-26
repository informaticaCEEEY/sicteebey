<?php
class ContextStateDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('context_state', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new ContextState(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setCategory(gosSanitizer::sanitizeForHTMLContent($category));
			$object->setQuestion(gosSanitizer::sanitizeForHTMLContent($question));
			$object->setAnswer(gosSanitizer::sanitizeForHTMLContent($answer));
			$object->setTotal(gosSanitizer::sanitizeForHTMLContent($total));
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

	public function add(ContextState $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(ContextState $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(ContextState $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
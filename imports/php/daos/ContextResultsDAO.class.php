<?php
class ContextResultsDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('context_results', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new ContextResults(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setFactor(gosSanitizer::sanitizeForHTMLContent($factor));
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

	public function add(ContextResults $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(ContextResults $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(ContextResults $entity=null){

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
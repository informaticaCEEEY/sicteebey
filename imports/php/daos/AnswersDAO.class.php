<?php
class AnswersDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('answers', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new Answers(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setName(($name));
			$object->setValue(gosSanitizer::sanitizeForHTMLContent($value));
            $object->setColor(gosSanitizer::sanitizeForHTMLContent($color));
            $object->setInverseColor(gosSanitizer::sanitizeForHTMLContent($inverse_color));
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

	public function add(Answers $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(Answers $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(Answers $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
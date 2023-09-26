<?php
class LearningContextDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('learning_context', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new LearningContext(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			$object->setFolio(gosSanitizer::sanitizeForHTMLContent($folio));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setP14O1(gosSanitizer::sanitizeForHTMLContent($P14O1));
			$object->setP14O2(gosSanitizer::sanitizeForHTMLContent($P14O2));
			$object->setP14O3(gosSanitizer::sanitizeForHTMLContent($P14O3));
			$object->setP14O4(gosSanitizer::sanitizeForHTMLContent($P14O4));
			$object->setP14O5(gosSanitizer::sanitizeForHTMLContent($P14O5));
			$object->setP14O6(gosSanitizer::sanitizeForHTMLContent($P14O6));
			$object->setP14O7(gosSanitizer::sanitizeForHTMLContent($P14O7));
			$object->setP14O8(gosSanitizer::sanitizeForHTMLContent($P14O8));
			$object->setAnswered(gosSanitizer::sanitizeForHTMLContent($answered));
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

	public function add(LearningContext $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(LearningContext $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(LearningContext $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}
    
    public function listObjects2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

        return $this -> listAll2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
    }

}
?>
<?php
class EnglishContextDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('english_context', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new EnglishContext(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			$object->setFolio(gosSanitizer::sanitizeForHTMLContent($folio));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setP14O9(gosSanitizer::sanitizeForHTMLContent($P14O9));
			$object->setP14O10(gosSanitizer::sanitizeForHTMLContent($P14O10));
			$object->setP14O11(gosSanitizer::sanitizeForHTMLContent($P14O11));
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

	public function add(EnglishContext $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(EnglishContext $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(EnglishContext $entity=null){

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
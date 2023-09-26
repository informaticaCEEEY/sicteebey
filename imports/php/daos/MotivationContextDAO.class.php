<?php
class MotivationContextDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('motivation_context', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new MotivationContext(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			$object->setFolio(gosSanitizer::sanitizeForHTMLContent($folio));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setP6O1(gosSanitizer::sanitizeForHTMLContent($P6O1));
			$object->setP6O2(gosSanitizer::sanitizeForHTMLContent($P6O2));
			$object->setP6O3(gosSanitizer::sanitizeForHTMLContent($P6O3));
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

	public function add(MotivationContext $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(MotivationContext $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(MotivationContext $entity=null){

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
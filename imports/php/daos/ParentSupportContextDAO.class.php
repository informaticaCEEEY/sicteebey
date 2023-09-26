<?php
class ParentSupportContextDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('parent_support_context', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new ParentSupportContext(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			$object->setFolio(gosSanitizer::sanitizeForHTMLContent($folio));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setP4O1(gosSanitizer::sanitizeForHTMLContent($P4O1));
			$object->setP4O2(gosSanitizer::sanitizeForHTMLContent($P4O2));
			$object->setP4O3(gosSanitizer::sanitizeForHTMLContent($P4O3));
			$object->setP4O4(gosSanitizer::sanitizeForHTMLContent($P4O4));
			$object->setP4O5(gosSanitizer::sanitizeForHTMLContent($P4O5));
			$object->setP4O6(gosSanitizer::sanitizeForHTMLContent($P4O6));
			$object->setP4O7(gosSanitizer::sanitizeForHTMLContent($P4O7));
			$object->setP4O8(gosSanitizer::sanitizeForHTMLContent($P4O8));
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

	public function add(ParentSupportContext $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(ParentSupportContext $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(ParentSupportContext $entity=null){

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
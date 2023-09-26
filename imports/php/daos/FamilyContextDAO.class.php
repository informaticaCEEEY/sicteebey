<?php
class FamilyContextDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('family_context', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new FamilyContext(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setR13_R20(gosSanitizer::sanitizeForHTMLContent($R13_R20));
			$object->setR14_R21(gosSanitizer::sanitizeForHTMLContent($R14_R21));
			$object->setR15_R24(gosSanitizer::sanitizeForHTMLContent($R15_R24));
			$object->setR16_R25(gosSanitizer::sanitizeForHTMLContent($R16_R25));
			$object->setR40_R62(gosSanitizer::sanitizeForHTMLContent($R40_R62));
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

	public function add(FamilyContext $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(FamilyContext $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(FamilyContext $entity=null){

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
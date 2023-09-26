<?php
class TeacherInteractionDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('teacher_interaction', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new TeacherInteraction(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setR8_R8(gosSanitizer::sanitizeForHTMLContent($R8_R8));
			$object->setR9_R9(gosSanitizer::sanitizeForHTMLContent($R9_R9));
			$object->setR10_R12(gosSanitizer::sanitizeForHTMLContent($R10_R12));
			$object->setR11_R17(gosSanitizer::sanitizeForHTMLContent($R11_R17));
			$object->setR12_R19(gosSanitizer::sanitizeForHTMLContent($R12_R19));
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

	public function add(TeacherInteraction $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(TeacherInteraction $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(TeacherInteraction $entity=null){

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
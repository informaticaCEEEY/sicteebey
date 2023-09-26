<?php
class SchoolEnvironmentDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('school_environment', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new SchoolEnvironment(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setR3_R3(gosSanitizer::sanitizeForHTMLContent($R3_R3));
			$object->setR4_R4(gosSanitizer::sanitizeForHTMLContent($R4_R4));
			$object->setR5_R5(gosSanitizer::sanitizeForHTMLContent($R5_R5));
			$object->setR6_R6(gosSanitizer::sanitizeForHTMLContent($R6_R6));
			$object->setR7_R7(gosSanitizer::sanitizeForHTMLContent($R7_R7));
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

	public function add(SchoolEnvironment $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(SchoolEnvironment $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(SchoolEnvironment $entity=null){

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
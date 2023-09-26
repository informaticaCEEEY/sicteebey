<?php
class StudentsDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('students', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new Students(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setLastName(gosSanitizer::sanitizeForHTMLContent($last_name));
			$object->setSecondName(gosSanitizer::sanitizeForHTMLContent($second_name));
			$object->setName(gosSanitizer::sanitizeForHTMLContent($name));
			$object->setCurp(gosSanitizer::sanitizeForHTMLContent($curp));
			$object->setGender(gosSanitizer::sanitizeForHTMLContent($gender));
			$object->setBirthDate(gosSanitizer::sanitizeForHTMLContent($birth_date));
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

	public function add(Students $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(Students $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(Students $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
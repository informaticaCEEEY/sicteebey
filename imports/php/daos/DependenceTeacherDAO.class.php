<?php
class DependenceTeacherDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('dependence_teacher', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new DependenceTeacher(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			$object->setFolio(gosSanitizer::sanitizeForHTMLContent($folio));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setP01(gosSanitizer::sanitizeForHTMLContent($P01));
			$object->setP02(gosSanitizer::sanitizeForHTMLContent($P02));
			$object->setP03(gosSanitizer::sanitizeForHTMLContent($P03));
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

	public function add(DependenceTeacher $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(DependenceTeacher $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(DependenceTeacher $entity=null){

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
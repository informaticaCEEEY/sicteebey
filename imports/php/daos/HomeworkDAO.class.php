<?php
class HomeworkDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('homework', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new Homework(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setR51_R73(gosSanitizer::sanitizeForHTMLContent($R51_R73));
			$object->setR52_R74(gosSanitizer::sanitizeForHTMLContent($R52_R74));
			$object->setR53_R75(gosSanitizer::sanitizeForHTMLContent($R53_R75));
			$object->setR54_R76(gosSanitizer::sanitizeForHTMLContent($R54_R76));
			$object->setR55_R77(gosSanitizer::sanitizeForHTMLContent($R55_R77));
			$object->setR56_R78(gosSanitizer::sanitizeForHTMLContent($R56_R78));
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

	public function add(Homework $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(Homework $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(Homework $entity=null){

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
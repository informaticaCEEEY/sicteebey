<?php
class Aprov16_17DAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('aprov16_17', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new Aprov16_17(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setIdStudent(gosSanitizer::sanitizeForHTMLContent($idStudent));
			$object->setYear(gosSanitizer::sanitizeForHTMLContent($year));
			$object->setGrade(gosSanitizer::sanitizeForHTMLContent($grade));
			$object->setGroup1(gosSanitizer::sanitizeForHTMLContent($group1));
			$object->setStatus(gosSanitizer::sanitizeForHTMLContent($status));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setCalGlobal(gosSanitizer::sanitizeForHTMLContent($cal_global));
			$object->setReprobate(gosSanitizer::sanitizeForHTMLContent($reprobate));
			$object->setGender(gosSanitizer::sanitizeForHTMLContent($gender));
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

	public function add(Aprov16_17 $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(Aprov16_17 $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(Aprov16_17 $entity=null){

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
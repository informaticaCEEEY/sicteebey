<?php
class FactorClassroom2DAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('factor_classroom2', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new FactorClassroom2(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setSchedule(gosSanitizer::sanitizeForHTMLContent($schedule));
			$object->setGrade(gosSanitizer::sanitizeForHTMLContent($grade));
			$object->setSchoolGroup(gosSanitizer::sanitizeForHTMLContent($school_group));
			$object->setFactor(gosSanitizer::sanitizeForHTMLContent($factor));
			$object->setMedia(gosSanitizer::sanitizeForHTMLContent($media));
			$object->setTotal(gosSanitizer::sanitizeForHTMLContent($total));
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

	public function add(FactorClassroom2 $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(FactorClassroom2 $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(FactorClassroom2 $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
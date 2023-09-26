<?php
class ContextScheduleDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('context_schedule', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new ContextSchedule(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setGrade(gosSanitizer::sanitizeForHTMLContent($grade));
			$object->setTotal(gosSanitizer::sanitizeForHTMLContent($total));
			$object->setType(gosSanitizer::sanitizeForHTMLContent($type));
			$object->setYear(gosSanitizer::sanitizeForHTMLContent($year));
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

	public function add(ContextSchedule $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(ContextSchedule $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(ContextSchedule $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
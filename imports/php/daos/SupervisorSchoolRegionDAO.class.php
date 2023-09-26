<?php
class SupervisorSchoolRegionDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('supervisor_school_region', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new SupervisorSchoolRegion(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setUser(gosSanitizer::sanitizeForHTMLContent($user));
			$object->setSchoolRegionZone(gosSanitizer::sanitizeForHTMLContent($school_region_zone));
			$object->setSchoolMode(gosSanitizer::sanitizeForHTMLContent($school_mode));
			$object->setSchoolZone(gosSanitizer::sanitizeForHTMLContent($school_zone));
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

	public function add(SupervisorSchoolRegion $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(SupervisorSchoolRegion $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(SupervisorSchoolRegion $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>

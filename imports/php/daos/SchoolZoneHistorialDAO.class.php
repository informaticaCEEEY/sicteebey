<?php
class SchoolZoneHistorialDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('school_zone_historial', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new SchoolZoneHistorial(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setSchoolRegionZone(gosSanitizer::sanitizeForHTMLContent($school_region_zone));
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

	public function add(SchoolZoneHistorial $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(SchoolZoneHistorial $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(SchoolZoneHistorial $entity=null){

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
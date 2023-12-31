<?php
class SchoolRegionZoneDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('school_region_zone', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new SchoolRegionZone(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setSchoolRegion(gosSanitizer::sanitizeForHTMLContent($school_region));
			$object->setLevel(gosSanitizer::sanitizeForHTMLContent($level));
			$object->setMode(gosSanitizer::sanitizeForHTMLContent($mode));
			$object->setZone(gosSanitizer::sanitizeForHTMLContent($zone));
            $object->setSector(gosSanitizer::sanitizeForHTMLContent($sector));
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

	public function add(SchoolRegionZone $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(SchoolRegionZone $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(SchoolRegionZone $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

	public function listObjects2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields, $groupby){

		return $this -> listAll2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields, $groupby);
	}

}
?>

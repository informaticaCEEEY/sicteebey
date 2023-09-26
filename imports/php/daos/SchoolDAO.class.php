<?php
class SchoolDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('school', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new School(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
            $object->setName(htmlspecialchars_decode($name));
			$object->setAddress(gosSanitizer::sanitizeForHTMLContent($address));
			$object->setSuburb(gosSanitizer::sanitizeForHTMLContent($suburb));
			$object->setCp(gosSanitizer::sanitizeForHTMLContent($cp));
			$object->setLevel(gosSanitizer::sanitizeForHTMLContent($level));
			$object->setSector(gosSanitizer::sanitizeForHTMLContent($sector));
			$object->setZone(gosSanitizer::sanitizeForHTMLContent($zone));
			$object->setSchedule(gosSanitizer::sanitizeForHTMLContent($schedule));
			$object->setMode(gosSanitizer::sanitizeForHTMLContent($mode));
			$object->setLocality(htmlspecialchars_decode($locality));
			$object->setTown(gosSanitizer::sanitizeForHTMLContent($town));
            $object->setCdiClassification(gosSanitizer::sanitizeForHTMLContent($cdi_classification));
			$object->setRegionZone(gosSanitizer::sanitizeForHTMLContent($region_zone));
			$object->setRegion_territory(gosSanitizer::sanitizeForHTMLContent($region_territory));
			$object->setMarginalization(gosSanitizer::sanitizeForHTMLContent($marginalization));
			$object->setSchoolRegionZone(gosSanitizer::sanitizeForHTMLContent($school_region_zone));
            $object->setOldSchoolRegion(gosSanitizer::sanitizeForHTMLContent($old_school_region));
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

	public function add(School $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(School $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(School $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields);
	}
    
    public function listObjects2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields){

        return $this -> listAll2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields);
    }

}
?>
<?php
class AprovModeDataDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('aprov_mode_data', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new AprovModeData(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setCohorte(gosSanitizer::sanitizeForHTMLContent($cohorte));
			$object->setSchoolPeriod(gosSanitizer::sanitizeForHTMLContent($school_period));
			$object->setMode(gosSanitizer::sanitizeForHTMLContent($mode));
			$object->setTotal(gosSanitizer::sanitizeForHTMLContent($total));
			$object->setNewStudents(gosSanitizer::sanitizeForHTMLContent($new_students));
			$object->setStudentsLeaving(gosSanitizer::sanitizeForHTMLContent($students_leaving));
			$object->setTotalIdeal(gosSanitizer::sanitizeForHTMLContent($total_ideal));
			$object->setNewStudentsIdeal(gosSanitizer::sanitizeForHTMLContent($new_students_ideal));
			$object->setStudentsIdealLeaving(gosSanitizer::sanitizeForHTMLContent($students_ideal_leaving));
			$object->setSlightLag(gosSanitizer::sanitizeForHTMLContent($slight_lag));
			$object->setSeriousLag(gosSanitizer::sanitizeForHTMLContent($serious_lag));
			$object->setUnregistered(gosSanitizer::sanitizeForHTMLContent($unregistered));
            $object->setUnregisteredThree(gosSanitizer::sanitizeForHTMLContent($unregistered_three));
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

	public function add(AprovModeData $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(AprovModeData $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(AprovModeData $entity=null){

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
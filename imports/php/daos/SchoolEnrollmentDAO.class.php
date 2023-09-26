<?php
class SchoolEnrollmentDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('school_enrollment', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new SchoolEnrollment(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setIdStudent(gosSanitizer::sanitizeForHTMLContent($id_student));
			$object->setStartYear(gosSanitizer::sanitizeForHTMLContent($start_year));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setGrade(gosSanitizer::sanitizeForHTMLContent($grade));
			$object->setSchoolGroup(gosSanitizer::sanitizeForHTMLContent($school_group));
			$object->setStatus(gosSanitizer::sanitizeForHTMLContent($status));
			$object->setFinalScore(gosSanitizer::sanitizeForHTMLContent($final_score));
			$object->setIdCohorte(gosSanitizer::sanitizeForHTMLContent($id_cohorte));
			$object->setInitialCohort(gosSanitizer::sanitizeForHTMLContent($initial_cohort));
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

	public function add(SchoolEnrollment $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(SchoolEnrollment $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(SchoolEnrollment $entity=null){

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
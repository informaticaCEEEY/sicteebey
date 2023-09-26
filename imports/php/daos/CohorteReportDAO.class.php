<?php
class CohorteReportDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('cohorte_report', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new CohorteReport(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setCohorte(gosSanitizer::sanitizeForHTMLContent($cohorte));
			$object->setTotalStudents(gosSanitizer::sanitizeForHTMLContent($total_students));
			$object->setSchoolPeriod(gosSanitizer::sanitizeForHTMLContent($school_period));
			$object->setEnrolledStudents(gosSanitizer::sanitizeForHTMLContent($enrolled_students));
			$object->setTotalIdealDegree(gosSanitizer::sanitizeForHTMLContent($total_ideal_degree));
			$object->setSlightLag(gosSanitizer::sanitizeForHTMLContent($slight_lag));
			$object->setSeriousLag(gosSanitizer::sanitizeForHTMLContent($serious_lag));
			$object->setUnregistered(gosSanitizer::sanitizeForHTMLContent($unregistered));
			$object->setUnregisteredThree(gosSanitizer::sanitizeForHTMLContent($unregistered_three));
			$object->setGraduates(gosSanitizer::sanitizeForHTMLContent($graduates));
			$object->setEnrolledNextGrade(gosSanitizer::sanitizeForHTMLContent($enrolled_next_grade));
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

	public function add(CohorteReport $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(CohorteReport $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(CohorteReport $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
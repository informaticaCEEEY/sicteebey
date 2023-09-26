<?php
class AprovStudentDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('aprov_student', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new AprovStudent(filter_var($id, FILTER_SANITIZE_NUMBER_INT));
			$object->setId(filter_var($id, FILTER_SANITIZE_NUMBER_INT));
			$object->setIdAprov(filter_var($id_aprov, FILTER_SANITIZE_NUMBER_INT));
			$object->setIdStudent(filter_var($idStudent, FILTER_SANITIZE_NUMBER_INT));
			$object->setYear(filter_var($year, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH | FILTER_FLAG_ENCODE_AMP));
			$object->setGrade(filter_var($grade, FILTER_SANITIZE_NUMBER_INT));
			$object->setGroup1(filter_var($group1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW));
			$object->setStatus(filter_var($status, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW));
			$object->setCct(filter_var($cct, FILTER_SANITIZE_NUMBER_INT));
			$object->setCalGlobal(filter_var($cal_global, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW));
			$object->setReprobate(filter_var($reprobate, FILTER_SANITIZE_NUMBER_INT));
			$object->setGender(filter_var($gender, FILTER_SANITIZE_NUMBER_INT));
			$object->setSchoolMode(filter_var($school_mode, FILTER_SANITIZE_NUMBER_INT));
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

	public function getEntityBy($field, $search, $order){

		$objects = $this -> getBy($field, $search, $order);
		if(count($objects)==1){

			return $objects[0];
		}else{
			return $objects;
		}
	}

	public function add(AprovStudent $entity=null){

		if($entity!=null){

			$objectId = $this->addObject($entity);
			return $objectId;
		}
	}

	public function update(AprovStudent $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(AprovStudent $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join) {

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

	public function listObjects2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields) {
		
		return $this -> listAll2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields);
	}

}
?>
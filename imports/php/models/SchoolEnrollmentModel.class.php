<?php
class SchoolEnrollmentModel{

	private $dao;

	function __construct(){

		$this->dao=new SchoolEnrollmentDAO();
	}

	public function countActives($value){

		return $this->dao->countActives();
	}

	public function countActivesBy($where, $whereFields, $join, $fields, $search){

		return $this->dao->countActives($where, $whereFields, $join, $fields, $search);
	}

	public function getEntity($value){

		return $this->dao->getEntity($value);
	}

	public function getBy($field, $search){

		return $this->dao->getEntity($field, $search);
	}

	public function addSchoolEnrollment(SchoolEnrollment $value){

		return $this->dao->add($value);
	}

	public function updateSchoolEnrollment(SchoolEnrollment $value){

		return $this->dao->update($value);
	}

	public function deleteSchoolEnrollment(SchoolEnrollment $value){

		return $this->dao->delete($value);
	}

	public function listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this->dao->listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

	public function listAll2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields){

		return $this->dao->listObjects2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields);
	}

}
?>
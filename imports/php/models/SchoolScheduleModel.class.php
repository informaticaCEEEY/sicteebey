<?php
class SchoolScheduleModel{

	private $dao;

	function __construct(){

		$this->dao=new SchoolScheduleDAO();
	}

	public function countActives($where, $whereFields){

		return $this->dao->countActives($where, $whereFields);
	}

	public function getEntity($value){

		return $this->dao->getEntity($value);
	}
	
	public function getBy($field, $search){

		return $this->dao->getBy($field, $search);
	}

	public function addSchoolSchedule(SchoolSchedule $value){

		return $this->dao->add($value);
	}

	public function updateSchoolSchedule(SchoolSchedule $value){

		return $this->dao->update($value);
	}

	public function deleteSchoolSchedule(SchoolSchedule $value){

		return $this->dao->delete($value);
	}

	public function listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this->dao->listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
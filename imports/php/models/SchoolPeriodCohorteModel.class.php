<?php
class SchoolPeriodCohorteModel{

	private $dao;

	function __construct(){

		$this->dao=new SchoolPeriodCohorteDAO();
	}

	public function countActives($where, $whereFields){

		return $this->dao->countActives($where, $whereFields);
	}

	public function getEntity($value){

		return $this->dao->getEntity($value);
	}
	
	public function getBy2($field, $search){

		return $this->dao->getBy($field, $search);
	}
	
	public function getBy($field, $search, $order){

		return $this->dao->getBy($field, $search, $order);
	}

	public function addSchoolPeriodCohorte(SchoolPeriodCohorte $value){

		return $this->dao->add($value);
	}

	public function updateSchoolPeriodCohorte(SchoolPeriodCohorte $value){

		return $this->dao->update($value);
	}

	public function deleteSchoolPeriodCohorte(SchoolPeriodCohorte $value){

		return $this->dao->delete($value);
	}

	public function listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this->dao->listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
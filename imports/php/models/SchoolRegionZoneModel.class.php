<?php
class SchoolRegionZoneModel{

	private $dao;

	function __construct(){

		$this->dao=new SchoolRegionZoneDAO();
	}

	public function countActives($where, $whereFields){

		return $this->dao->countActives($where, $whereFields);
	}

	public function countActivesBy($where, $whereFields, $join, $fields, $search){

		return $this->dao->countActivesBy($where, $whereFields, $join, $fields, $search);
	}

	public function getEntity($value){

		return $this->dao->getEntity($value);
	}

	public function getBy($field, $search){

		return $this->dao->getBy($field, $search);
	}

	public function addSchoolRegionZone(SchoolRegionZone $value){

		return $this->dao->add($value);
	}

	public function updateSchoolRegionZone(SchoolRegionZone $value){

		return $this->dao->update($value);
	}

	public function deleteSchoolRegionZone(SchoolRegionZone $value){

		return $this->dao->delete($value);
	}

	public function listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this->dao->listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

	public function listAll2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields, $groupby){

		return $this->dao->listObjects2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields, $groupby);
	}

}
?>

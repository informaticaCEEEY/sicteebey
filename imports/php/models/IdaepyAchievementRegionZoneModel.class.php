<?php
class IdaepyAchievementRegionZoneModel{

	private $dao;

	function __construct(){

		$this->dao=new IdaepyAchievementRegionZoneDAO();
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

	public function addIdaepyAchievementRegionZone(IdaepyAchievementRegionZone $value){

		return $this->dao->add($value);
	}

	public function updateIdaepyAchievementRegionZone(IdaepyAchievementRegionZone $value){

		return $this->dao->update($value);
	}

	public function deleteIdaepyAchievementRegionZone(IdaepyAchievementRegionZone $value){

		return $this->dao->delete($value);
	}

	public function listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this->dao->listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
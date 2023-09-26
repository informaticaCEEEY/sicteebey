<?php
class AchievementSubjectModel{

	private $dao;

	function __construct(){

		$this->dao=new AchievementSubjectDAO();
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

	public function addAchievementSubject(AchievementSubject $value){

		return $this->dao->add($value);
	}

	public function updateAchievementSubject(AchievementSubject $value){

		return $this->dao->update($value);
	}

	public function deleteAchievementSubject(AchievementSubject $value){

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
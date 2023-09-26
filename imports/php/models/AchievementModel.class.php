<?php
class AchievementModel{

	private $dao;

	function __construct(){

		$this->dao=new AchievementDAO();
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

	public function addAchievement(Achievement $value){

		return $this->dao->add($value);
	}

	public function updateAchievement(Achievement $value){

		return $this->dao->update($value);
	}

	public function deleteAchievement(Achievement $value){

		return $this->dao->delete($value);
	}

	public function listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this->dao->listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
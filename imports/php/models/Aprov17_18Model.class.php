<?php
class Aprov17_18Model{

	private $dao;

	function __construct(){

		$this->dao=new Aprov17_18DAO();
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

	public function addAprov17_18(Aprov17_18 $value){

		return $this->dao->add($value);
	}

	public function updateAprov17_18(Aprov17_18 $value){

		return $this->dao->update($value);
	}

	public function deleteAprov17_18(Aprov17_18 $value){

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
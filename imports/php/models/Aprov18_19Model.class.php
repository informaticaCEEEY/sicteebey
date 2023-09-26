<?php
class Aprov18_19Model{

	private $dao;

	function __construct(){

		$this->dao=new Aprov18_19DAO();
	}

	public function countActives($where, $whereFields){

		return $this->dao->countActives($where, $whereFields);
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

	public function addAprov18_19(Aprov18_19 $value){

		return $this->dao->add($value);
	}

	public function updateAprov18_19(Aprov18_19 $value){

		return $this->dao->update($value);
	}

	public function deleteAprov18_19(Aprov18_19 $value){

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
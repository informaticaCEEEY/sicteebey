<?php
class Aprov15_16Model{

	private $dao;

	function __construct(){

		$this->dao=new Aprov15_16DAO();
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

	public function addAprov15_16(Aprov15_16 $value){

		return $this->dao->add($value);
	}

	public function updateAprov15_16(Aprov15_16 $value){

		return $this->dao->update($value);
	}

	public function deleteAprov15_16(Aprov15_16 $value){

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
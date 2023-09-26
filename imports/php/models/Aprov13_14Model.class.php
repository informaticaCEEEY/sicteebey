<?php
class Aprov13_14Model{

	private $dao;

	function __construct(){

		$this->dao=new Aprov13_14DAO();
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

	public function addAprov13_14(Aprov13_14 $value){

		return $this->dao->add($value);
	}

	public function updateAprov13_14(Aprov13_14 $value){

		return $this->dao->update($value);
	}

	public function deleteAprov13_14(Aprov13_14 $value){

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
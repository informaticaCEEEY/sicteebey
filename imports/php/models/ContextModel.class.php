<?php
class ContextModel{

	private $dao;

	function __construct(){

		$this->dao=new ContextDAO();
	}

	public function countActives($where, $whereFields, $join){

		return $this->dao->countActives($where, $whereFields, $join);
	}

	public function getEntity($value){

		return $this->dao->getEntity($value);
	}

	public function getBy($field, $search){

		return $this->dao->getBy($field, $search);
	}

	public function addContext(Context $value){

		return $this->dao->add($value);
	}

	public function updateContext(Context $value){

		return $this->dao->update($value);
	}

	public function deleteContext(Context $value){

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
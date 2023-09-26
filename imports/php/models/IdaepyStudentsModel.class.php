<?php
class IdaepyStudentsModel{

	private $dao;

	function __construct(){

		$this->dao=new IdaepyStudentsDAO();
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

	public function addIdaepyStudents(IdaepyStudents $value){

		return $this->dao->add($value);
	}

	public function updateIdaepyStudents(IdaepyStudents $value){

		return $this->dao->update($value);
	}

	public function deleteIdaepyStudents(IdaepyStudents $value){

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
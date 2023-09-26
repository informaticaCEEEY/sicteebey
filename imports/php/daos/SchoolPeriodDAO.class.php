<?php
class SchoolPeriodDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('school_period', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new SchoolPeriod(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setName(gosSanitizer::sanitizeForHTMLContent($name));
			$object->setTablePeriod(gosSanitizer::sanitizeForHTMLContent($table_period));
			$object->setStartYear(gosSanitizer::sanitizeForHTMLContent($start_year));
			$object->setEndYear(gosSanitizer::sanitizeForHTMLContent($end_year));
			return $object;
		}else{
			return null;
		}
	}

	public function getEntity($id){

		$objects = $this -> getBy($this -> keyValue, $id);
		if(count($objects)==1){

			return $objects[0];
		}else{
			return null;
		}
	}

	public function add(SchoolPeriod $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(SchoolPeriod $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(SchoolPeriod $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>

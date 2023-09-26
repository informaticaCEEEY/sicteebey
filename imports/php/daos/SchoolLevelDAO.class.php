<?php
class SchoolLevelDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('school_level', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new SchoolLevel(($id));
			$object->setId($id);
			$object->setName(gosSanitizer::sanitizeForHTMLContent($name));
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

	public function add(SchoolLevel $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(SchoolLevel $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(SchoolLevel $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
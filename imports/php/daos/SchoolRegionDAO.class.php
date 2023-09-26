<?php
class SchoolRegionDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('school_region', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new SchoolRegion(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setName(htmlspecialchars_decode($name));
            $object->setAlternativeName(htmlspecialchars_decode($alternative_name));
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

	public function add(SchoolRegion $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(SchoolRegion $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(SchoolRegion $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}
	
	public function listObjects2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields);
	}

}
?>
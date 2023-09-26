<?php
class HealthDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('health', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new Health(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setR40(gosSanitizer::sanitizeForHTMLContent($R40));
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

	public function add(Health $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(Health $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(Health $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}
	
	public function listObjects2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields){

		return $this -> listAll2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields);
	}

}
?>
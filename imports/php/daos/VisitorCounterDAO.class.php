<?php
class VisitorCounterDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('visitor_counter', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new VisitorCounter(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setVisitDate(gosSanitizer::sanitizeForHTMLContent($visit_date));
			$object->setIpAddress(gosSanitizer::sanitizeForHTMLContent($ip_address));
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

	public function add(VisitorCounter $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(VisitorCounter $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(VisitorCounter $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
<?php
class FactorDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('factor', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new Factor(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setName(htmlspecialchars_decode($name));
      $object->setType(gosSanitizer::sanitizeForHTMLContent($type));
      $object->setDescription(($description));
      $object->setYearApplication(gosSanitizer::sanitizeForHTMLContent($year_application));
      $object->setTrend(gosSanitizer::sanitizeForHTMLContent($trend));
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

	public function add(Factor $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(Factor $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(Factor $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>

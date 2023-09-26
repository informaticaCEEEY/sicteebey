<?php
class DrinksConsumptionDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('drinks_consumption', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new DrinksConsumption(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setR25_R34(gosSanitizer::sanitizeForHTMLContent($R25_R34));
			$object->setR26_R35(gosSanitizer::sanitizeForHTMLContent($R26_R35));
			$object->setR27_R36(gosSanitizer::sanitizeForHTMLContent($R27_R36));
			$object->setR28_R37(gosSanitizer::sanitizeForHTMLContent($R28_R37));
			$object->setR29_R38(gosSanitizer::sanitizeForHTMLContent($R29_R38));
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

	public function add(DrinksConsumption $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(DrinksConsumption $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(DrinksConsumption $entity=null){

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
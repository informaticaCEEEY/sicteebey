<?php
class FoodConsumptionDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('food_consumption', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new FoodConsumption(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setR17_R26(gosSanitizer::sanitizeForHTMLContent($R17_R26));
			$object->setR18_R27(gosSanitizer::sanitizeForHTMLContent($R18_R27));
			$object->setR19_R28(gosSanitizer::sanitizeForHTMLContent($R19_R28));
			$object->setR20_R29(gosSanitizer::sanitizeForHTMLContent($R20_R29));
			$object->setR21_R30(gosSanitizer::sanitizeForHTMLContent($R21_R30));
			$object->setR22_R31(gosSanitizer::sanitizeForHTMLContent($R22_R31));
			$object->setR23_R32(gosSanitizer::sanitizeForHTMLContent($R23_R32));
			$object->setR24_R33(gosSanitizer::sanitizeForHTMLContent($R24_R33));
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

	public function add(FoodConsumption $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(FoodConsumption $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(FoodConsumption $entity=null){

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
<?php
class EconomicCapitalContextDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('economic_capital_context', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new EconomicCapitalContext(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			$object->setFolio(gosSanitizer::sanitizeForHTMLContent($folio));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setP1O1(gosSanitizer::sanitizeForHTMLContent($P1O1));
			$object->setP1O2(gosSanitizer::sanitizeForHTMLContent($P1O2));
			$object->setP2O1(gosSanitizer::sanitizeForHTMLContent($P2O1));
			$object->setP2O2(gosSanitizer::sanitizeForHTMLContent($P2O2));
			$object->setP2O3(gosSanitizer::sanitizeForHTMLContent($P2O3));
			$object->setP2O4(gosSanitizer::sanitizeForHTMLContent($P2O4));
			$object->setP2O5(gosSanitizer::sanitizeForHTMLContent($P2O5));
			$object->setP2O6(gosSanitizer::sanitizeForHTMLContent($P2O6));
			$object->setAnswered(gosSanitizer::sanitizeForHTMLContent($answered));
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

	public function add(EconomicCapitalContext $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(EconomicCapitalContext $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(EconomicCapitalContext $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}
    
    public function listObjects2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

        return $this -> listAll2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
    }

}
?>
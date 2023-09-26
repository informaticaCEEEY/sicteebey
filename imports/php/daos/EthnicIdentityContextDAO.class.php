<?php
class EthnicIdentityContextDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('ethnic_identity_context', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new EthnicIdentityContext(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			$object->setFolio(gosSanitizer::sanitizeForHTMLContent($folio));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setP10O1(gosSanitizer::sanitizeForHTMLContent($P10O1));
			$object->setP10O2(gosSanitizer::sanitizeForHTMLContent($P10O2));
			$object->setP10O3(gosSanitizer::sanitizeForHTMLContent($P10O3));
			$object->setP10O5(gosSanitizer::sanitizeForHTMLContent($P10O5));
			$object->setP11O5(gosSanitizer::sanitizeForHTMLContent($P11O5));
			$object->setP11O6(gosSanitizer::sanitizeForHTMLContent($P11O6));
			$object->setP11O7(gosSanitizer::sanitizeForHTMLContent($P11O7));
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

	public function add(EthnicIdentityContext $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(EthnicIdentityContext $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(EthnicIdentityContext $entity=null){

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
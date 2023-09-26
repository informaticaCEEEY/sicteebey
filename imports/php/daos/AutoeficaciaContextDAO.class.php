<?php
class AutoeficaciaContextDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('autoeficacia_context', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new AutoeficaciaContext(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			$object->setFolio(gosSanitizer::sanitizeForHTMLContent($folio));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setP8O1(gosSanitizer::sanitizeForHTMLContent($P8O1));
			$object->setP8O2(gosSanitizer::sanitizeForHTMLContent($P8O2));
			$object->setP8O3(gosSanitizer::sanitizeForHTMLContent($P8O3));
			$object->setP8O4(gosSanitizer::sanitizeForHTMLContent($P8O4));
			$object->setP8O5(gosSanitizer::sanitizeForHTMLContent($P8O5));
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

	public function add(AutoeficaciaContext $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(AutoeficaciaContext $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(AutoeficaciaContext $entity=null){

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
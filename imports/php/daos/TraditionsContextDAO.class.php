<?php
class TraditionsContextDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('traditions_context', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new TraditionsContext(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			$object->setFolio(gosSanitizer::sanitizeForHTMLContent($folio));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setP11O2(gosSanitizer::sanitizeForHTMLContent($P11O2));
			$object->setP11O3(gosSanitizer::sanitizeForHTMLContent($P11O3));
			$object->setP11O4(gosSanitizer::sanitizeForHTMLContent($P11O4));
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

	public function add(TraditionsContext $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(TraditionsContext $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(TraditionsContext $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
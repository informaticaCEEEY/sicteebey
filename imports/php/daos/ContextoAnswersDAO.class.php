<?php
class ContextoAnswersDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('contexto_answers', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new ContextoAnswers(gosSanitizer::sanitizeForHTMLContent($id));
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
			$object->setP4O1(gosSanitizer::sanitizeForHTMLContent($P4O1));
			$object->setP4O2(gosSanitizer::sanitizeForHTMLContent($P4O2));
			$object->setP4O3(gosSanitizer::sanitizeForHTMLContent($P4O3));
			$object->setP4O4(gosSanitizer::sanitizeForHTMLContent($P4O4));
			$object->setP4O5(gosSanitizer::sanitizeForHTMLContent($P4O5));
			$object->setP4O6(gosSanitizer::sanitizeForHTMLContent($P4O6));
			$object->setP4O7(gosSanitizer::sanitizeForHTMLContent($P4O7));
			$object->setP4O8(gosSanitizer::sanitizeForHTMLContent($P4O8));
			$object->setP5O(gosSanitizer::sanitizeForHTMLContent($P5O));
			$object->setP6O1(gosSanitizer::sanitizeForHTMLContent($P6O1));
			$object->setP6O2(gosSanitizer::sanitizeForHTMLContent($P6O2));
			$object->setP6O3(gosSanitizer::sanitizeForHTMLContent($P6O3));
			$object->setP6O4(gosSanitizer::sanitizeForHTMLContent($P6O4));
			$object->setP7O1(gosSanitizer::sanitizeForHTMLContent($P7O1));
			$object->setP7O2(gosSanitizer::sanitizeForHTMLContent($P7O2));
			$object->setP7O3(gosSanitizer::sanitizeForHTMLContent($P7O3));
			$object->setP7O5(gosSanitizer::sanitizeForHTMLContent($P7O5));
			$object->setP7O4(gosSanitizer::sanitizeForHTMLContent($P7O4));
			$object->setP7O7(gosSanitizer::sanitizeForHTMLContent($P7O7));
			$object->setP7O6(gosSanitizer::sanitizeForHTMLContent($P7O6));
			$object->setP8O1(gosSanitizer::sanitizeForHTMLContent($P8O1));
			$object->setP8O2(gosSanitizer::sanitizeForHTMLContent($P8O2));
			$object->setP8O3(gosSanitizer::sanitizeForHTMLContent($P8O3));
			$object->setP8O4(gosSanitizer::sanitizeForHTMLContent($P8O4));
			$object->setP8O5(gosSanitizer::sanitizeForHTMLContent($P8O5));
			$object->setP9O1(gosSanitizer::sanitizeForHTMLContent($P9O1));
			$object->setP9O2(gosSanitizer::sanitizeForHTMLContent($P9O2));
			$object->setP9O3(gosSanitizer::sanitizeForHTMLContent($P9O3));
			$object->setP9O4(gosSanitizer::sanitizeForHTMLContent($P9O4));
			$object->setP10O1(gosSanitizer::sanitizeForHTMLContent($P10O1));
			$object->setP10O2(gosSanitizer::sanitizeForHTMLContent($P10O2));
			$object->setP10O3(gosSanitizer::sanitizeForHTMLContent($P10O3));
			$object->setP10O4(gosSanitizer::sanitizeForHTMLContent($P10O4));
			$object->setP10O5(gosSanitizer::sanitizeForHTMLContent($P10O5));
			$object->setP11O1(gosSanitizer::sanitizeForHTMLContent($P11O1));
			$object->setP11O2(gosSanitizer::sanitizeForHTMLContent($P11O2));
			$object->setP11O3(gosSanitizer::sanitizeForHTMLContent($P11O3));
			$object->setP11O4(gosSanitizer::sanitizeForHTMLContent($P11O4));
			$object->setP11O5(gosSanitizer::sanitizeForHTMLContent($P11O5));
			$object->setP11O6(gosSanitizer::sanitizeForHTMLContent($P11O6));
			$object->setP11O7(gosSanitizer::sanitizeForHTMLContent($P11O7));
			$object->setP11O8(gosSanitizer::sanitizeForHTMLContent($P11O8));
			$object->setP14O1(gosSanitizer::sanitizeForHTMLContent($P14O1));
			$object->setP14O2(gosSanitizer::sanitizeForHTMLContent($P14O2));
			$object->setP14O3(gosSanitizer::sanitizeForHTMLContent($P14O3));
			$object->setP14O4(gosSanitizer::sanitizeForHTMLContent($P14O4));
			$object->setP14O5(gosSanitizer::sanitizeForHTMLContent($P14O5));
			$object->setP14O6(gosSanitizer::sanitizeForHTMLContent($P14O6));
			$object->setP14O7(gosSanitizer::sanitizeForHTMLContent($P14O7));
			$object->setP14O8(gosSanitizer::sanitizeForHTMLContent($P14O8));
			$object->setP14O9(gosSanitizer::sanitizeForHTMLContent($P14O9));
			$object->setP14O10(gosSanitizer::sanitizeForHTMLContent($P14O10));
			$object->setP14O11(gosSanitizer::sanitizeForHTMLContent($P14O11));
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

	public function add(ContextoAnswers $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(ContextoAnswers $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(ContextoAnswers $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
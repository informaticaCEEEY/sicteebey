<?php
class FactorCctDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('factor_cct', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new FactorCct(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setFactor(gosSanitizer::sanitizeForHTMLContent($factor));
			$object->setMedia(gosSanitizer::sanitizeForHTMLContent($media));
			$object->setFactorCount(gosSanitizer::sanitizeForHTMLContent($factor_count));
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

	public function add(FactorCct $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(FactorCct $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(FactorCct $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
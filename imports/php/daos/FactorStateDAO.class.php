<?php
class FactorStateDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('factor_state', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new FactorState(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setFactor(gosSanitizer::sanitizeForHTMLContent($factor));
			$object->setMedia(gosSanitizer::sanitizeForHTMLContent($media));
			$object->setFactorCount(gosSanitizer::sanitizeForHTMLContent($factor_count));
            $object->setYear(gosSanitizer::sanitizeForHTMLContent($year));
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

	public function add(FactorState $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(FactorState $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(FactorState $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
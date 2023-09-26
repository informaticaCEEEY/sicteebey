<?php
class FactorsIndexDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('factors_index', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new FactorsIndex(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setFactor(gosSanitizer::sanitizeForHTMLContent($factor));
			$object->setIndexList(gosSanitizer::sanitizeForHTMLContent($index_list));
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

	public function add(FactorsIndex $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(FactorsIndex $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(FactorsIndex $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
<?php
class IndexRegionDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('index_region', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new IndexRegion(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setRegion(gosSanitizer::sanitizeForHTMLContent($region));
			$object->setIndexList(gosSanitizer::sanitizeForHTMLContent($index_list));
			$object->setMedia(gosSanitizer::sanitizeForHTMLContent($media));
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

	public function add(IndexRegion $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(IndexRegion $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(IndexRegion $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
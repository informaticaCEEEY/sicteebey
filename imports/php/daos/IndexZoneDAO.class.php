<?php
class IndexZoneDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('index_zone', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new IndexZone(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setModality(gosSanitizer::sanitizeForHTMLContent($modality));
			$object->setSchoolRegion(gosSanitizer::sanitizeForHTMLContent($school_region));
			$object->setZone(gosSanitizer::sanitizeForHTMLContent($zone));
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

	public function add(IndexZone $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(IndexZone $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(IndexZone $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>

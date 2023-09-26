<?php
class MayanLanguageDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('mayan_language', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new MayanLanguage(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setR57_R79(gosSanitizer::sanitizeForHTMLContent($R57_R79));
			$object->setR58_R80(gosSanitizer::sanitizeForHTMLContent($R58_R80));
			$object->setR59_R81(gosSanitizer::sanitizeForHTMLContent($R59_R81));
			$object->setR60_R84(gosSanitizer::sanitizeForHTMLContent($R60_R84));
			$object->setR61_R85(gosSanitizer::sanitizeForHTMLContent($R61_R85));
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

	public function add(MayanLanguage $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(MayanLanguage $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(MayanLanguage $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}
    
    public function listObjects2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields){

        return $this -> listAll2($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join, $showFields);
    }

}
?>
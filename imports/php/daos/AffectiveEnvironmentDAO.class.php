<?php
class AffectiveEnvironmentDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('affective_environment', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new AffectiveEnvironment(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setR43_R64(gosSanitizer::sanitizeForHTMLContent($R43_R64));
			$object->setR44_R65(gosSanitizer::sanitizeForHTMLContent($R44_R65));
			$object->setR45_R66(gosSanitizer::sanitizeForHTMLContent($R45_R66));
			$object->setR46_R67(gosSanitizer::sanitizeForHTMLContent($R46_R67));
			$object->setR47_R68(gosSanitizer::sanitizeForHTMLContent($R47_R68));
			$object->setR48_R69(gosSanitizer::sanitizeForHTMLContent($R48_R69));
			$object->setR49_R71(gosSanitizer::sanitizeForHTMLContent($R49_R71));
			$object->setR50_R72(gosSanitizer::sanitizeForHTMLContent($R50_R72));
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

	public function add(AffectiveEnvironment $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(AffectiveEnvironment $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(AffectiveEnvironment $entity=null){

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
<?php
class StudyTechniquesContextDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('study_techniques_context', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new StudyTechniquesContext(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
			//$object->setFolio(gosSanitizer::sanitizeForHTMLContent($folio));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setP7O1(gosSanitizer::sanitizeForHTMLContent($P7O1));
			$object->setP7O2(gosSanitizer::sanitizeForHTMLContent($P7O2));
			$object->setP7O3(gosSanitizer::sanitizeForHTMLContent($P7O3));
			$object->setP7O5(gosSanitizer::sanitizeForHTMLContent($P7O5));
			$object->setP7O4(gosSanitizer::sanitizeForHTMLContent($P7O4));
			$object->setP7O7(gosSanitizer::sanitizeForHTMLContent($P7O7));
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

	public function add(StudyTechniquesContext $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(StudyTechniquesContext $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(StudyTechniquesContext $entity=null){

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
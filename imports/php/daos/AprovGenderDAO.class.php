<?php
class AprovGenderDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('aprov_gender', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new AprovGender(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setCohorte(gosSanitizer::sanitizeForHTMLContent($cohorte));
			$object->setSchoolPeriod(gosSanitizer::sanitizeForHTMLContent($school_period));
			$object->setGrade(gosSanitizer::sanitizeForHTMLContent($grade));
			$object->setTotalMen(gosSanitizer::sanitizeForHTMLContent($total_men));
			$object->setTotalWomen(gosSanitizer::sanitizeForHTMLContent($total_women));
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

	public function add(AprovGender $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(AprovGender $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(AprovGender $entity=null){

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
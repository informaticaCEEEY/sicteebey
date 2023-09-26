<?php
class AprovStatusDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('aprov_status', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new AprovStatus(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setCohorte(gosSanitizer::sanitizeForHTMLContent($cohorte));
			$object->setSchoolPeriod(gosSanitizer::sanitizeForHTMLContent($school_period));
			$object->setStatusA(gosSanitizer::sanitizeForHTMLContent($statusA));
			$object->setStatusR(gosSanitizer::sanitizeForHTMLContent($statusR));
			$object->setStatusX(gosSanitizer::sanitizeForHTMLContent($statusX));
			$object->setStatusZ(gosSanitizer::sanitizeForHTMLContent($statusZ));
            $object->setUnregisteredThree(gosSanitizer::sanitizeForHTMLContent($unregistered_three));
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

	public function add(AprovStatus $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(AprovStatus $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(AprovStatus $entity=null){

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
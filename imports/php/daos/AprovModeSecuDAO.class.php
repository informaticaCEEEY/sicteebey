<?php
class AprovModeSecuDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('aprov_mode_secu', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new AprovModeSecu(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setCohorte(gosSanitizer::sanitizeForHTMLContent($cohorte));
			$object->setSchoolPeriod(gosSanitizer::sanitizeForHTMLContent($school_period));
			$object->setMode(gosSanitizer::sanitizeForHTMLContent($mode));
			$object->setTotal(gosSanitizer::sanitizeForHTMLContent($total));
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

	public function add(AprovModeSecu $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(AprovModeSecu $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(AprovModeSecu $entity=null){

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
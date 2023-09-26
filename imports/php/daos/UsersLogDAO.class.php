<?php
class UsersLogDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('users_log', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new UsersLog(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setUser(gosSanitizer::sanitizeForHTMLContent($user));
			$object->setActivityDate(gosSanitizer::sanitizeForHTMLContent($activity_date));
			$object->setActivity(gosSanitizer::sanitizeForHTMLContent($activity));
			$object->setDescription(gosSanitizer::sanitizeForHTMLContent($description));
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

	public function add(UsersLog $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(UsersLog $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(UsersLog $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
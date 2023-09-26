<?php
class UsersDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('users', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new Users(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setType(gosSanitizer::sanitizeForHTMLContent($type));
			$object->setUserName(gosSanitizer::sanitizeForHTMLContent($user_name));
			$object->setName(gosSanitizer::sanitizeForHTMLContent($name));
			$object->setLastName(gosSanitizer::sanitizeForHTMLContent($last_name));
			$object->setSecondName(gosSanitizer::sanitizeForHTMLContent($second_name));
			$object->setEmail(gosSanitizer::sanitizeForHTMLContent($email));
			$object->setPassword(gosSanitizer::sanitizeForHTMLContent($password));
			$object->setTitle(gosSanitizer::sanitizeForHTMLContent($title));
			$object->setGender(gosSanitizer::sanitizeForHTMLContent($gender));
			$object->setSchool(gosSanitizer::sanitizeForHTMLContent($school));
			$object->setSchoolLevel(gosSanitizer::sanitizeForHTMLContent($school_level));
			$object->setAbbreviation(gosSanitizer::sanitizeForHTMLContent($abbreviation));
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

	public function add(Users $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(Users $entity=null){

		if($entity!=null){			
			$this->updateObject($entity);
		}
	}

	public function delete(Users $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
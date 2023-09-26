<?php
class AchievementDescriptionDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('achievement_description', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new AchievementDescription(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setAchievement(gosSanitizer::sanitizeForHTMLContent($achievement));
			$object->setSubject(gosSanitizer::sanitizeForHTMLContent($subject));
			$object->setGrade(gosSanitizer::sanitizeForHTMLContent($grade));
			$object->setDescription(htmlspecialchars_decode($description));
			$object->setYear(gosSanitizer::sanitizeForHTMLContent($year));
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

	public function add(AchievementDescription $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(AchievementDescription $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(AchievementDescription $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
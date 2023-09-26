<?php
class IdaepyAchievementDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('idaepy_achievement', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new IdaepyAchievement(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setStudent(gosSanitizer::sanitizeForHTMLContent($student));
            $object->setPercentageHits(gosSanitizer::sanitizeForHTMLContent($percentage_hits));
			$object->setPercentageMath(gosSanitizer::sanitizeForHTMLContent($percentage_math));
			$object->setPercentageScience(gosSanitizer::sanitizeForHTMLContent($percentage_science));
			$object->setPercentageSpanish(gosSanitizer::sanitizeForHTMLContent($percentage_spanish));
			$object->setAchievementMath(gosSanitizer::sanitizeForHTMLContent($achievement_math));
			$object->setAchievementScience(gosSanitizer::sanitizeForHTMLContent($achievement_science));
			$object->setAchievementSpanish(gosSanitizer::sanitizeForHTMLContent($achievement_spanish));
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

	public function add(IdaepyAchievement $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(IdaepyAchievement $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(IdaepyAchievement $entity=null){

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
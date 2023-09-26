<?php
class IdaepyAchievementRegionZoneDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('idaepy_achievement_region_zone', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new IdaepyAchievementRegionZone(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setSchoolRegionZone(gosSanitizer::sanitizeForHTMLContent($school_region_zone));
			$object->setEvaluated(gosSanitizer::sanitizeForHTMLContent($evaluated));
			$object->setHitsPercentage(gosSanitizer::sanitizeForHTMLContent($hits_percentage));
			$object->setMathPercentage(gosSanitizer::sanitizeForHTMLContent($math_percentage));
			$object->setSciencePercentage(gosSanitizer::sanitizeForHTMLContent($science_percentage));
			$object->setSpanishPercentage(gosSanitizer::sanitizeForHTMLContent($spanish_percentage));
			$object->setMathAchievementBasic(gosSanitizer::sanitizeForHTMLContent($math_achievement_basic));
			$object->setMathAchievementMedium(gosSanitizer::sanitizeForHTMLContent($math_achievement_medium));
			$object->setMathAchievementAdvanced(gosSanitizer::sanitizeForHTMLContent($math_achievement_advanced));
			$object->setSpanishAchievementBasic(gosSanitizer::sanitizeForHTMLContent($spanish_achievement_basic));
			$object->setSpanishAchievementMedium(gosSanitizer::sanitizeForHTMLContent($spanish_achievement_medium));
			$object->setSpanishAchievementAdvanced(gosSanitizer::sanitizeForHTMLContent($spanish_achievement_advanced));
			$object->setScienceAchievementBasic(gosSanitizer::sanitizeForHTMLContent($science_achievement_basic));
			$object->setScienceAchievementMedium(gosSanitizer::sanitizeForHTMLContent($science_achievement_medium));
			$object->setScienceAchievementAdvanced(gosSanitizer::sanitizeForHTMLContent($science_achievement_advanced));
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

	public function add(IdaepyAchievementRegionZone $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(IdaepyAchievementRegionZone $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(IdaepyAchievementRegionZone $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
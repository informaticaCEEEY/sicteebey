<?php
class AchievementIdaepyDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('achievement_idaepy', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new AchievementIdaepy(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setAchievement(gosSanitizer::sanitizeForHTMLContent($achievement));
			$object->setYear(gosSanitizer::sanitizeForHTMLContent($year));
			$object->setOrderNumber(gosSanitizer::sanitizeForHTMLContent($order_number));
			$object->setCodeR(gosSanitizer::sanitizeForHTMLContent($codeR));
			$object->setCodeG(gosSanitizer::sanitizeForHTMLContent($codeG));
			$object->setCodeB(gosSanitizer::sanitizeForHTMLContent($codeB));
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

	public function add(AchievementIdaepy $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(AchievementIdaepy $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(AchievementIdaepy $entity=null){

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
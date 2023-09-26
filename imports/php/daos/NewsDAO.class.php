<?php
class NewsDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('news', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new News(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setType(gosSanitizer::sanitizeForHTMLContent($type));
			$object->setDate(gosSanitizer::sanitizeForHTMLContent($date));
			$object->setStatus(gosSanitizer::sanitizeForHTMLContent($status));
			$object->setImage(gosSanitizer::sanitizeForHTMLContent($image));
			$object->setTitle(gosSanitizer::sanitizeForHTMLContent($title));
			$object->setSummary(gosSanitizer::sanitizeForHTMLContent($summary));
			//$object->setContent(iconv('ISO-8859-1','UTF-8//TRANSLIT',$content));
			$object->setContent(htmlspecialchars_decode($content, ENT_QUOTES));
			$object->setAutor(gosSanitizer::sanitizeForHTMLContent($autor));
			$object->setPublicationDate(gosSanitizer::sanitizeForHTMLContent($publication_date));
			$object->setRedirect(gosSanitizer::sanitizeForHTMLContent(htmlspecialchars_decode($redirect, ENT_QUOTES)));
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

	public function add(News $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(News $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(News $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>
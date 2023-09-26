<?php
class IndexZone{

	private $id;

	private $modality;

	private $schoolRegion;

	private $zone;

	private $indexList;

	private $media;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}

    public function getIndexListObject() {

        $controller = new IndexListController();
        $entity = $controller -> getEntityAction($this -> indexList);
        return $entity;
    }

	public function setId($id){

		$this->id=Validate::validateInteger($id);
	}

	public function getId(){

		return $this->id;
	}

	public function setModality($modality){

		$this->modality=Validate::validateInteger($modality);
	}

	public function getModality(){

		return $this->modality;
	}

	public function setSchoolRegion($schoolRegion){

		$this->schoolRegion=Validate::validateInteger($schoolRegion);
	}

	public function getSchoolRegion(){

		return $this->schoolRegion;
	}

	public function setZone($zone){

		$this->zone=Validate::validateInteger($zone);
	}

	public function getZone(){

		return $this->zone;
	}

	public function setIndexList($indexList){

		$this->indexList=Validate::validateInteger($indexList);
	}

	public function getIndexList(){

		return $this->indexList;
	}

	public function setMedia($media){

		$this->media=$media;
	}

	public function getMedia(){

		return $this->media;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getModality());
		array_push($vector, $this->getSchoolRegion());
		array_push($vector, $this->getZone());
		array_push($vector, $this->getIndexList());
		array_push($vector, $this->getMedia());
		return $vector;
	}
}
?>

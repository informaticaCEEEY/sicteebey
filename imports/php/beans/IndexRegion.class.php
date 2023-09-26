<?php
class IndexRegion{

	private $id;

	private $region;

	private $indexList;

	private $media;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}
    
    public function getRegionObject() {

        $controller = new SchoolRegionController();
        $entity = $controller -> getEntityAction($this -> region);
        return $entity;
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

	public function setRegion($region){

		$this->region=$region;
	}

	public function getRegion(){

		return $this->region;
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
		array_push($vector, $this->getRegion());
		array_push($vector, $this->getIndexList());
		array_push($vector, $this->getMedia());
		return $vector;
	}
}
?>
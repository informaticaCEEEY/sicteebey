<?php
class IndexState{

	private $id;

	private $indexList;

	private $media;

	private $total;

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

	public function setTotal($total){

		$this->total=Validate::validateInteger($total);
	}

	public function getTotal(){

		return $this->total;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getIndexList());
		array_push($vector, $this->getMedia());
		array_push($vector, $this->getTotal());
		return $vector;
	}
}
?>
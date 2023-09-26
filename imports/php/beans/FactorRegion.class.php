<?php
class FactorRegion{

	private $id;

	private $region;

	private $factor;

	private $media;

	private $factorCount;

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
	
	public function getFactorObject() {

		$controller = new FactorController();
		$entity = $controller -> getEntityAction($this -> factor);
		return $entity;
	}
	
	public function setId($id){

		$this->id=Validate::validateInteger($id);
	}

	public function getId(){

		return $this->id;
	}

	public function setRegion($region){

		$this->region=Validate::validateInteger($region);
	}

	public function getRegion(){

		return $this->region;
	}

	public function setFactor($factor){

		$this->factor=Validate::validateInteger($factor);
	}

	public function getFactor(){

		return $this->factor;
	}

	public function setMedia($media){

		$this->media=$media;
	}

	public function getMedia(){

		return $this->media;
	}

	public function setFactorCount($factorCount){

		$this->factorCount=Validate::validateInteger($factorCount);
	}

	public function getFactorCount(){

		return $this->factorCount;
        
    }

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getRegion());
		array_push($vector, $this->getFactor());
		array_push($vector, $this->getMedia());
		array_push($vector, $this->getFactorCount());
		return $vector;
	}
}
?>
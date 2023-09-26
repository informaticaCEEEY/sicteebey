<?php
class FactorState{

	private $id;

	private $factor;

	private $media;

	private $factorCount;
    
    private $year;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
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
    
    public function setYear($year){

        $this->year=$year;
    }

    public function getYear(){

        return $this->year;
    }

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getFactor());
		array_push($vector, $this->getMedia());
		array_push($vector, $this->getFactorCount());
        array_push($vector, $this->getYear());
		return $vector;
	}
}
?>
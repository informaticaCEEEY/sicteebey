<?php
class FactorZone{

	private $id;
    
    private $modality;
    
    private $schoolRegion;

	private $zone;
    
    private $level;

	private $factor;

	private $media;

	private $factorCount;

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

		$this->zone=$zone;
	}

	public function getZone(){

		return $this->zone;
	}
    
    public function setLevel($level){

        $this->level=Validate::validateInteger($level);
    }

    public function getLevel(){

        return $this->level;
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
        array_push($vector, $this->getModality());
		array_push($vector, $this->getSchoolRegion());
        array_push($vector, $this->getZone());
        array_push($vector, $this->getLevel());
		array_push($vector, $this->getFactor());
		array_push($vector, $this->getMedia());
		array_push($vector, $this->getFactorCount());
		return $vector;
	}
}
?>
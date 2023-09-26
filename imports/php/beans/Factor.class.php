<?php
class Factor{

	private $id;

	private $type;
    
    private $name;
    
    private $description;
    
    private $yearApplication;
    
    private $trend;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}
	public function setId($id){

		$this->id=Validate::validateInteger($id);
	}

	public function getId(){

		return $this->id;
	}

	public function setName($name){

		$this->name=Validate::validateEmpty($name);
	}

	public function getName(){

		return $this->name;
	}
    
    public function setType($type){

        $this->type=Validate::validateInteger($type);
    }

    public function getType(){

        return $this->type;
    }

	public function setDescription($description){

        $this->description=($description);
    }

    public function getDescription(){

        return $this->description;
    }
    
    public function setYearApplication($yearApplication){

        $this->yearApplication=($yearApplication);
    }

    public function getYearApplication(){

        return $this->yearApplication;
    }
    
    public function setTrend($trend){

        $this->trend=($trend);
    }

    public function getTrend(){

        return $this->trend;
    }

    public function dataVector(){

        $vector= array();
        array_push($vector, $this->getId());
        array_push($vector, $this->getName());
        array_push($vector, $this->getType());
        array_push($vector, $this->getDescription());
        array_push($vector, $this->getYearApplication());
        array_push($vector, $this->getTrend());
        return $vector;
    }
}
?>
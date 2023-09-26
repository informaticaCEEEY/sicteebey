<?php
class Achievement{

	private $id;

	private $name;
    
    private $orderLevel;

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

		$this->name=$name;
	}

	public function getName(){

		return $this->name;
	}
    
    public function setOrderLevel($orderLevel){

        $this->orderLevel=$orderLevel;
    }

    public function getOrderLevel(){

        return $this->orderLevel;
    }

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getName());
        array_push($vector, $this->getOrderLevel());
		return $vector;
	}
}
?>
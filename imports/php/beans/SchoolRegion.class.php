<?php
class SchoolRegion{

	private $id;

	private $name;
    
    private $alternativeName;

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
    
    
    public function setAlternativeName($alternativeName){

        $this->alternativeName=Validate::validateEmpty($alternativeName);
    }

    public function getAlternativeName(){

        return $this->alternativeName;
    }

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getName());
        array_push($vector, $this->getAlternativeName());
		return $vector;
	}
}
?>


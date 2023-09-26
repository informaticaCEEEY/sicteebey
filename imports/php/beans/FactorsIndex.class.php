<?php
class FactorsIndex{

	private $id;

	private $factor;

	private $indexList;

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

	public function setIndexList($indexList){

		$this->indexList=Validate::validateInteger($indexList);
	}

	public function getIndexList(){

		return $this->indexList;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getFactor());
		array_push($vector, $this->getIndexList());
		return $vector;
	}
}
?>
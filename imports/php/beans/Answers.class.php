<?php
class Answers{

    private $id;

    private $name;

    private $value;

    private $color;

    private $inverseColor;

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

    public function setValue($value){

        $this->value=Validate::validateInteger($value);
    }

    public function getValue(){

        return $this->value;
    }

    public function setColor($color){

        $this->color=$color;
    }

    public function getColor(){

        return $this->color;
    }

    public function setInverseColor($inverseColor){

        $this->inverseColor=$inverseColor;
    }

    public function getInverseColor(){

        return $this->inverseColor;
    }

    public function dataVector(){

        $vector= array();
        array_push($vector, $this->getId());
        array_push($vector, $this->getName());
        array_push($vector, $this->getValue());
        array_push($vector, $this->getColor());
        array_push($vector, $this->getInverseColor());
        return $vector;
    }
}
?>
<?php
class MayanLanguage{

	private $id;

	private $student;

	private $cct;

	private $R57_R79;

	private $R58_R80;

	private $R59_R81;

	private $R60_R84;

	private $R61_R85;

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

	public function setStudent($student){

		$this->student=Validate::validateInteger($student);
	}

	public function getStudent(){

		return $this->student;
	}

	public function setCct($cct){

		$this->cct=$cct;
	}

	public function getCct(){

		return $this->cct;
	}

	public function setR57_R79($R57_R79){

		$this->R57_R79=Validate::validateInteger($R57_R79);
	}

	public function getR57_R79(){

		return $this->R57_R79;
	}

	public function setR58_R80($R58_R80){

		$this->R58_R80=Validate::validateInteger($R58_R80);
	}

	public function getR58_R80(){

		return $this->R58_R80;
	}

	public function setR59_R81($R59_R81){

		$this->R59_R81=Validate::validateInteger($R59_R81);
	}

	public function getR59_R81(){

		return $this->R59_R81;
	}

	public function setR60_R84($R60_R84){

		$this->R60_R84=Validate::validateInteger($R60_R84);
	}

	public function getR60_R84(){

		return $this->R60_R84;
	}

	public function setR61_R85($R61_R85){

		$this->R61_R85=Validate::validateInteger($R61_R85);
	}

	public function getR61_R85(){

		return $this->R61_R85;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getStudent());
		array_push($vector, $this->getCct());
		array_push($vector, $this->getR57_R79());
		array_push($vector, $this->getR58_R80());
		array_push($vector, $this->getR59_R81());
		array_push($vector, $this->getR60_R84());
		array_push($vector, $this->getR61_R85());
		return $vector;
	}
}
?>
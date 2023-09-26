<?php
class AffectiveEnvironment{

	private $id;

	private $student;

	private $cct;

	private $R43_R64;

	private $R44_R65;

	private $R45_R66;

	private $R46_R67;

	private $R47_R68;

	private $R48_R69;

	private $R49_R71;

	private $R50_R72;

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

	public function setR43_R64($R43_R64){

		$this->R43_R64=Validate::validateInteger($R43_R64);
	}

	public function getR43_R64(){

		return $this->R43_R64;
	}

	public function setR44_R65($R44_R65){

		$this->R44_R65=Validate::validateInteger($R44_R65);
	}

	public function getR44_R65(){

		return $this->R44_R65;
	}

	public function setR45_R66($R45_R66){

		$this->R45_R66=Validate::validateInteger($R45_R66);
	}

	public function getR45_R66(){

		return $this->R45_R66;
	}

	public function setR46_R67($R46_R67){

		$this->R46_R67=Validate::validateInteger($R46_R67);
	}

	public function getR46_R67(){

		return $this->R46_R67;
	}

	public function setR47_R68($R47_R68){

		$this->R47_R68=Validate::validateInteger($R47_R68);
	}

	public function getR47_R68(){

		return $this->R47_R68;
	}

	public function setR48_R69($R48_R69){

		$this->R48_R69=Validate::validateInteger($R48_R69);
	}

	public function getR48_R69(){

		return $this->R48_R69;
	}

	public function setR49_R71($R49_R71){

		$this->R49_R71=Validate::validateInteger($R49_R71);
	}

	public function getR49_R71(){

		return $this->R49_R71;
	}

	public function setR50_R72($R50_R72){

		$this->R50_R72=Validate::validateInteger($R50_R72);
	}

	public function getR50_R72(){

		return $this->R50_R72;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getStudent());
		array_push($vector, $this->getCct());
		array_push($vector, $this->getR43_R64());
		array_push($vector, $this->getR44_R65());
		array_push($vector, $this->getR45_R66());
		array_push($vector, $this->getR46_R67());
		array_push($vector, $this->getR47_R68());
		array_push($vector, $this->getR48_R69());
		array_push($vector, $this->getR49_R71());
		array_push($vector, $this->getR50_R72());
		return $vector;
	}
}
?>
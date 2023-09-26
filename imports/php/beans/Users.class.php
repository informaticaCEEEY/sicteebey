<?php
class Users{

	private $id;

	private $type;
	
	private $userName;

	private $name;

	private $lastName;

	private $secondName;

	private $email;
	
	private $gender;
	
	private $school;
	
	private $schoolLevel;

	private $password;
	
	private $title;
	
	private $abbreviation;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}
	
	public function getSchoolObject() {

		$controller = new SchoolController();
		$entity = $controller -> getEntityAction($this -> school);
		return $entity;
	}
	
	public function getUserTypeObject() {

		$controller = new UserTypeController();
		$entity = $controller -> getEntityAction($this -> type);
		return $entity;
	}
	
	public function getCompleteName(){

		return $this->title . ' ' . $this->name . ' ' . $this->lastName. ' ' . $this->secondName;
	}
	
	public function __toString(){

		return $this->name . ' ' . $this->lastName. ' ' . $this->secondName;
	}
	
	public function setId($id){

		$this->id=Validate::validateInteger($id);
	}

	public function getId(){

		return $this->id;
	}

	public function setType($type){

		$this->type=Validate::validateInteger($type);
	}

	public function getType(){

		return $this->type;
	}
	
	public function setUserName($userName){

		$this->userName=$userName;
	}

	public function getUserName(){

		return $this->userName;
	}

	public function setName($name){

		$this->name=$name;
	}

	public function getName(){

		return $this->name;
	}

	public function setLastName($lastName){

		$this->lastName=$lastName;
	}

	public function getLastName(){

		return $this->lastName;
	}

	public function setSecondName($secondName){

		$this->secondName=$secondName;
	}

	public function getSecondName(){

		return $this->secondName;
	}

	public function setEmail($email){

		$this->email=Validate::validateEmail($email);
	}

	public function getEmail(){

		return $this->email;
	}

	public function setPassword($password){

		$this->password=$password;
	}

	public function getPassword(){

		return $this->password;
	}
	
	public function setGender($gender){

		$this->gender=Validate::validateInteger($gender);
	}

	public function getGender(){

		return $this->gender;
	}
	
	public function setSchool($school){

		$this->school=Validate::validateInteger($school);
	}

	public function getSchool(){

		return $this->school;
	}
	
	public function setSchoolLevel($schoolLevel){

		$this->schoolLevel=Validate::validateInteger($schoolLevel);
	}

	public function getSchoolLevel(){

		return $this->schoolLevel;
	}
	
	public function setTitle($title){

		$this->title=$title;
	}

	public function getTitle(){

		return $this->title;
	}
	
	public function setAbbreviation($abbreviation){

		$this->abbreviation=$abbreviation;
	}

	public function getAbbreviation(){

		return $this->abbreviation;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getType());
		array_push($vector, $this->getUserName());
		array_push($vector, $this->getName());
		array_push($vector, $this->getLastName());
		array_push($vector, $this->getSecondName());		
		array_push($vector, $this->getEmail());
		array_push($vector, $this->getPassword());
		array_push($vector, $this->getTitle());
		array_push($vector, $this->getGender());
		array_push($vector, $this->getSchool());
		array_push($vector, $this->getSchoolLevel());
		array_push($vector, $this->getAbbreviation());
		return $vector;
	}
}
?>
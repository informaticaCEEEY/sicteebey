<?php
class UsersLog{

	private $id;

	private $user;

	private $activityDate;

	private $activity;

	private $description;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}

  public function getUserObject() {

    $controller = new UsersController();
    $entity = $controller -> getEntityAction($this -> user);
    return $entity;
  }

	public function getActivityObject() {

    $controller = new LogTypeController();
    $entity = $controller -> getEntityAction($this -> activity);
    return $entity;
  }

	public function setId($id){

		$this->id=Validate::validateInteger($id);
	}

	public function getId(){

		return $this->id;
	}

	public function setUser($user){

		$this->user=Validate::validateInteger($user);
	}

	public function getUser(){

		return $this->user;
	}

	public function setActivityDate($activityDate){

		$this->activityDate=Validate::validateEmpty($activityDate);
	}

	public function getActivityDate(){

		return $this->activityDate;
	}

	public function setActivity($activity){

		$this->activity=Validate::validateEmpty($activity);
	}

	public function getActivity(){

		return $this->activity;
	}

	public function setDescription($description){

		$this->description=$description;
	}

	public function getDescription(){

		return $this->description;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getUser());
		array_push($vector, $this->getActivityDate());
		array_push($vector, $this->getActivity());
		array_push($vector, $this->getDescription());
		return $vector;
	}
}
?>

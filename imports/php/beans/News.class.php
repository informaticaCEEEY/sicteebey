<?php
class News{

	private $id;

	private $type;

	private $date;

	private $status;
	
	private $image;

	private $title;
	
	private $summary;

	private $content;

	private $autor;

	private $publicationDate;
	
	private $redirect;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}
	
	public function getNewsTypeObject() {

		$controller = new NewsTypeController();
		$entity = $controller -> getEntityAction($this -> type);
		return $entity;
	}
	
	public function getNewsStatusObject() {

		$controller = new NewsStatusController();
		$entity = $controller -> getEntityAction($this -> status);
		return $entity;
	}
	
	public function setId($id){

		$this->id=$id;
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

	public function setDate($date){

		$this->date=Validate::validateEmpty($date);
	}

	public function getDate(){

		return $this->date;
	}

	public function setStatus($status){

		$this->status=Validate::validateInteger($status);
	}

	public function getStatus(){

		return $this->status;
	}
	
	public function setImage($image){
		
		$this->image=Validate::validateEmpty($image);
	}
	
	public function getImage(){
		
		return $this->image;
	}
	
	public function setTitle($title){

		$this->title=Validate::validateEmpty($title);
	}

	public function getTitle(){

		return $this->title;
	}
	
	public function setSummary($summary){

		$this->summary=Validate::validateEmpty($summary);
	}

	public function getSummary(){

		return $this->summary;
	}

	public function setContent($content){

		$this->content=Validate::validateEmpty($content);
	}

	public function getContent(){

		return $this->content;
	}

	public function setAutor($autor){

		$this->autor=Validate::validateInteger($autor);
	}

	public function getAutor(){

		return $this->autor;
	}

	public function setPublicationDate($publicationDate){

		$this->publicationDate=Validate::validateEmpty($publicationDate);
	}

	public function getPublicationDate(){

		return $this->publicationDate;
	}
	
	public function setRedirect($redirect){

		$this->redirect=$redirect;
	}

	public function getRedirect(){

		return $this->redirect;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getType());
		array_push($vector, $this->getDate());
		array_push($vector, $this->getStatus());
		array_push($vector, $this->getImage());
		array_push($vector, $this->getTitle());
		array_push($vector, $this->getSummary());
		array_push($vector, $this->getContent());
		array_push($vector, $this->getAutor());
		array_push($vector, $this->getPublicationDate());
		array_push($vector, $this->getRedirect());
		return $vector;
	}
}
?>
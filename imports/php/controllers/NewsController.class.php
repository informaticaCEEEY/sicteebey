<?php
class NewsController{

	private $model;

	function __construct(){

		$this->model=new NewsModel();
	}

	public function displayAction(){

		return $this->model->listAll('', '', '', '', '', '', '', '');
	}
	
	public function displayByAction($where='', $whereFields='', $join=''){
		
		return $this->model->listAll('', '', '', '', '', $where, $whereFields, $join);
	}
	
	public function displayBy2Action($startLimit, $endLimit, $order, $where='', $whereFields='', $join=''){

		return $this->model->listAll($startLimit, $endLimit, '', '', $order, $where, $whereFields, $join);
	}

	public function getEntityAction($id){

		return $this->model->getEntity($id);
	}
	
	public function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function createAction(){

		extract($_POST);
		try{

			$date = new DateTime('', new DateTimeZone('America/Mexico_City'));
			$publicationDate = DateTime::createFromFormat('d/m/Y H:i', $publicationDate, new DateTimeZone('America/Mexico_City'));

			if(strlen($summary) > 150){
				throw new Exception('El resumen excede la longitud máxima permitida');
			}

			if(!filter_var($redirect, FILTER_VALIDATE_URL) === false) {
				throw new Exception('El enlace no es válido');
			}

			if($_FILES['image']['error'] > 0){
				throw new Exception("Error: " . $_FILES['image']['error']);
			}

			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mime = finfo_file($finfo, $_FILES['image']['tmp_name']);
			$fileDir = "../../docs/imagenes/";
			switch ($mime) {
				case 'image/jpeg':
					$fileExtension = '.jpg';
					break;
				case 'image/png':
					$fileExtension = '.png';
					break;
				default:
					throw new Exception('Imagen no válida. Solo se permiten JPG o PNG');
					break;
			}

			$fileName = $this->generateRandomString(12);
			move_uploaded_file($_FILES["image"]["tmp_name"], $fileDir.$fileName.$fileExtension);

			$object= new News();
			$object->setType($type);
			$object->setDate($date->format('Y-m-d H:i:s'));
			$object->setStatus($status);
			$object->setImage($fileName.$fileExtension);
			$object->setTitle($title);
			$object->setSummary($summary);
			$object->setContent(htmlspecialchars($content, ENT_QUOTES,'UTF-8'));
			$object->setAutor($autor);
			$object->setPublicationDate($publicationDate->format('Y-m-d H:i:s'));
			$object->setRedirect($redirect);
			$this -> model -> addNews($object);

			$activityDate = new DateTime('', new DateTimeZone('America/Mexico_City'));

			$userLog = new UsersLog();
			$userLog->setUser($autor);
			$userLog->setActivityDate($activityDate->format('Y-m-d H:i:s'));
			$userLog->setActivity(3);
			$userLogModel = new UsersLogModel();
			$userLogModel->addUsersLog($userLog);


		}catch(Exception $e){
			$_SESSION['flash'] = $e->getMessage();
			echo('<script>javascript:history.go(-1)</script>');
		}
	}

	public function updateAction(){

		extract($_POST);
		if(isset($id)){
			$object= $this-> getEntityAction($id);
		}else{
			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
		if(is_null($object)){

			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
		try{

			$date = new DateTime('', new DateTimeZone('America/Mexico_City'));
			$publicationDate = DateTime::createFromFormat('d/m/Y H:i', $publicationDate, new DateTimeZone('America/Mexico_City'));

			if(strlen($summary) > 150){
			  throw new Exception('El resumen excede la longitud máxima permitida');
			}

			if(!filter_var($redirect, FILTER_VALIDATE_URL) === false) {
			  throw new Exception('El enlace no es válido');
			}

			$fileN = explode(".", $object->getImage());

			if(isset($_FILES['image']) && $_FILES['image']['error'] != 4){
				if($_FILES['image']['error'] > 0){
					throw new Exception("Error: " . $_FILES['image']['error']);
				}

				$finfo = finfo_open(FILEINFO_MIME_TYPE);
				$mime = finfo_file($finfo, $_FILES['image']['tmp_name']);
				$fileDir = $_SERVER['DOCUMENT_ROOT']."/docs/imagenes/";
				switch ($mime) {
					case 'image/jpeg':
						$fileExtension = '.jpg';
						break;
					case 'image/png':
						$fileExtension = '.png';
						break;
					default:
						throw new Exception('Imagen no válida. Solo se permiten JPG o PNG');
						break;
				}
				$fileName = $fileN[0].$fileExtension;				
				move_uploaded_file($_FILES["image"]["tmp_name"], $fileDir.$fileName);
			}else {
				$fileName = $object->getImage();
			}

			$object->setType($type);
			$object->setDate($date->format('Y-m-d H:i:s'));
			$object->setStatus($status);
			$object->setImage($fileName);
			$object->setTitle($title);
			$object->setSummary($summary);
			$object->setContent(htmlspecialchars($content, ENT_QUOTES,'UTF-8'));
			$object->setPublicationDate($publicationDate->format('Y-m-d H:i:s'));
			$object->setRedirect($redirect);
			$this -> model -> updateNews($object);

			$activityDate = new DateTime('', new DateTimeZone('America/Mexico_City'));

			$userLog = new UsersLog();
			$userLog->setUser($autor);
			$userLog->setActivityDate($activityDate->format('Y-m-d H:i:s'));
			$userLog->setActivity(4);
			$userLogModel = new UsersLogModel();
			$userLogModel->addUsersLog($userLog);

			$_SESSION['flash'] = 'Actualizaci&oacute;n correcta';
		}catch(Exception $e){
			$_SESSION['flash'] = $e->getMessage();
			echo('<script>javascript:history.go(-1)</script>');
		}
	}

	public function deleteAction(){

		extract($_POST);
		extract($_GET);
		if(isset($form_id) && isset($id) && is_numeric($form_id) && is_numeric($id) && $id==$form_id){

			$form_id = intval($form_id);
			$object = $this -> getEntityAction($form_id);
			if($object != null){

				$this -> model -> deleteNews($object);
			}
		}else{
			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
	}

	public function listAction() {

		$fields = array(0 => 'e.title', 1 => 'e.type', 2 => 'e.status', 3 => 'e.publication_date');
		$where = '';
		$whereFields = '';
		$join = '';
		//$total = $this -> model -> countActives($where, $whereFields);
		if(!isset($_GET['sSearch'])){
			$total = $this -> model -> countActives($where, $whereFields, $join);
		}else{
			$total = $this -> model -> countActivesBy($where, $whereFields, $join, $fields, $_GET['sSearch']);
		}
		if ($total == 0) {
			$output = array("sEcho" => intval($_GET['sEcho']), "iTotalRecords" => count(0), "iTotalDisplayRecords" => count(0), "aaData" => array());
		} else {
			$order = '';
			if (isset($_GET['iSortCol_0'])) {
				for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
					if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
						if (intval($_GET['iSortCol_' . $i]) == 0) {
							$order .= $fields[intval($_GET['iSortCol_' . $i])] . " " . $_GET['sSortDir_' . $i] . ", ";
						} else {
							$order .= $fields[intval($_GET['iSortCol_' . $i]) - 1] . " " . $_GET['sSortDir_' . $i] . ", ";
						}
					}
				}
				$order = substr_replace($order, "", -2);
			}
			$result = $this -> model -> listAll($_GET['iDisplayStart'], $_GET['iDisplayLength'], $_GET['sSearch'], $fields, $order, $where, $whereFields, $join);
			$output = array("sEcho" => intval($_GET['sEcho']), "iTotalRecords" => $total, "iTotalDisplayRecords" => $total, "aaData" => array());

			$controller = new UsersController();

			foreach ($result as $data) {

				$date = new DateTime($data->getPublicationDate(), new DateTimeZone('	America/Mexico_City'));

				$row = array();
				$row[] = $data -> getId();
				$row[] = $data -> getTitle();
				$row[] = $data -> getNewsTypeObject() -> getName();
				$row[] = $data -> getNewsStatusObject() -> getName();
				$row[] = $date -> format('d-m-Y h:s');
				$output['aaData'][] = $row;
			}
		}
		echo(json_encode($output));
	}

	public function listAllAction() {

		$fields = array(0 => 'e.title', 1 => 'e.publication_date');
		$date = new DateTime('', new DateTimeZone('	America/Mexico_City'));
		$where = "status = :status AND type = :type AND publication_date <= :publication_date";
		$whereFields = array('status' => 1, 'type' => 1, 'publication_date' => $date->format('Y-m-d H:i:s'));
		$join = '';		
		$total = $this -> model -> countActives($where, $whereFields);
		if ($total == 0) {
			$output = array("sEcho" => intval($_GET['sEcho']), "iTotalRecords" => count(0), "iTotalDisplayRecords" => count(0), "aaData" => array());
		} else {
			$order = '';
			if (isset($_GET['iSortCol_0'])) {

				for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {

					if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {

						if (intval($_GET['iSortCol_' . $i]) == 0) {

							$order .= $fields[intval($_GET['iSortCol_' . $i])] . " " . $_GET['sSortDir_' . $i] . ", ";
						} else {

							$order .= $fields[intval($_GET['iSortCol_' . $i]) - 1] . " " . $_GET['sSortDir_' . $i] . ", ";
						}
					}
				}
				$order = substr_replace($order, "", -2);
			}
			$order = "e.publication_date desc";
			$result = $this -> model -> listAll($_GET['iDisplayStart'], $_GET['iDisplayLength'], $_GET['sSearch'], $fields, $order, $where, $whereFields, $join);
			$output = array("sEcho" => intval($_GET['sEcho']), "iTotalRecords" => $total, "iTotalDisplayRecords" => $total, "aaData" => array());
			
			$controller = new UsersController();
					
			foreach ($result as $data) {
					
				$date = new DateTime($data->getPublicationDate(), new DateTimeZone('	America/Mexico_City'));

				$row = array();
				$row[] = $data -> getId();
				$row[] = '<a href="news.php?id='.$data->getId().'">'.$data -> getTitle().'</a>';
				$row[] = $date -> format('d-m-Y h:s');
				$output['aaData'][] = $row;
			}
		}
		echo(json_encode($output));
	}

}
?>
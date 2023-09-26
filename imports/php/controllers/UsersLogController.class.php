<?php
class UsersLogController{

	private $model;

	function __construct(){

		$this->model=new UsersLogModel();
	}

	public function displayAction(){

		return $this->model->listAll('', '', '', '', '', '', '', '');
	}

	public function displayByAction($where='', $whereFields='', $join='', $order=''){

		return $this->model->listAll('', '', '', '', $order, $where, $whereFields, $join);
	}

	public function getEntityAction($id){

		return $this->model->getEntity($id);
	}

	public function getEntityByAction($field, $search){

		return $this->model->getBy($field, $search);
	}

	public function createAction(){

		extract($_POST);
		try{
			$object= new UsersLog();
			$object->setUser($user);
			$object->setActivityDate($activityDate);
			$object->setActivity($activity);
			$object->setDescription($description);
			$this -> model -> addUsersLog($object);
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
			$object->setUser($user);
			$object->setActivityDate($activityDate);
			$object->setActivity($activity);
			$object->setDescription($description);
			$this -> model -> updateUsersLog($object);
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

				$this -> model -> deleteUsersLog($object);
			}
		}else{
			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
	}
	
	public function encrypt_decrypt($action, $cadena) {
	    $output = false;

	    $encrypt_method = "MCRYPT_RIJNDAEL_256";
	    $secret_key = 'This is my secret key';
	    $secret_iv = 'This is my secret iv';

	    // hash
	    $key = hash('sha256', $secret_key);

	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 32);

	    if( $action == 'encrypt' ) {
	        $output = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, $iv);
	        $output = base64_encode($output);
	    }
	    else if( $action == 'decrypt' ){
	    	$cadena = base64_decode($cadena);
	    	$output = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, $iv));
	        //$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    }

	    return $output;
    }

	public function listAction() {

		$fields = array(0 => 'users.name', 1 => 'log_type.name', 2 => 'e.activity_date');
		$date = new DateTime('', new DateTimeZone('	America/Mexico_City'));
		$where = '';
		$whereFields = '';
		$join = 'INNER JOIN users ON users.id = e.user
						 INNER JOIN log_type ON log_type.id = e.activity';
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
			$order = "e.activity_date desc";
			$result = $this -> model -> listAll($_GET['iDisplayStart'], $_GET['iDisplayLength'], $_GET['sSearch'], $fields, $order, $where, $whereFields, $join);
			$output = array("sEcho" => intval($_GET['sEcho']), "iTotalRecords" => $total, "iTotalDisplayRecords" => $total, "aaData" => array());

			$controller = new UsersController();

			foreach ($result as $data) {

				$date = new DateTime($data->getActivityDate(), new DateTimeZone('	America/Mexico_City'));

				$row = array();
				$row[] = $data -> getId();
				$row[] = $data -> getUserObject() -> __toString();
				$row[] = $data -> getActivityObject() -> getName();
				$row[] = $date -> format('d-m-Y H:i:s');
				$output['aaData'][] = $row;
			}
		}
		echo(json_encode($output));
	}
	
	public function listAdAction() {

		$fields = array(0 => 'users.name', 1 => 'log_type.name', 2 => 'e.activity_date');
		$date = new DateTime('', new DateTimeZone('	America/Mexico_City'));
		$where = '';
		$whereFields = '';
		$join = 'INNER JOIN users ON users.id = e.user
						 INNER JOIN log_type ON log_type.id = e.activity';
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
			$order = "e.activity_date desc";
			$result = $this -> model -> listAll($_GET['iDisplayStart'], $_GET['iDisplayLength'], $_GET['sSearch'], $fields, $order, $where, $whereFields, $join);
			$output = array("sEcho" => intval($_GET['sEcho']), "iTotalRecords" => $total, "iTotalDisplayRecords" => $total, "aaData" => array());

			$controller = new UsersController();

			foreach ($result as $data) {
				$date = new DateTime($data->getActivityDate(), new DateTimeZone('	America/Mexico_City'));

				$row = array();				
				$row[] = $data -> getId();
				$row[] = $data -> getUserObject() -> __toString();
				$row[] = $data -> getActivityObject() -> getName();
				$row[] = $date -> format('d-m-Y H:i:s');
				$row[] = '';
				$output['aaData'][] = $row;
			}
		}
		echo(json_encode($output));
	}

}
?>

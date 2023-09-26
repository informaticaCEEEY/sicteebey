<?php
class UsersController{

	private $model;

	function __construct(){

		$this->model=new UsersModel();
	}

	public function displayAction(){

		return $this->model->listAll('', '', '', '', '', '', '', '');
	}

	public function displayByAction($where='', $whereFields='', $join=''){

		return $this->model->listAll('', '', '', '', '', $where, $whereFields, $join);
	}

	public function getEntityAction($id){

		return $this->model->getEntity($id);
	}

	public function getEntityByAction($field, $search){

		return $this->model->getBy($field, $search);
	}

	public function loginIdaepyAction($userName, $password){

		$userName = filter_var($userName, FILTER_SANITIZE_STRING);
		$controller = new IdaepyStudentsController();
		$where = "e.folio = :folio AND e.year = 2019";
		$whereFields = array('folio' => $userName);
		$user = $controller->displayByAction($where, $whereFields);

		if(isset($user[0])){
			ini_set("session.cookie_lifetime","36000");
			session_start();
			$_SESSION['name'] = 'c3E3y_Tr4Y3Ct0r14S';
			$_SESSION['user'] = serialize($user['0']);
			$_SESSION['idx'] = '1DA3PY_2019';
			$_SESSION['message'] = 'Acceso Correcto';

			$activityDate = new DateTime('', new DateTimeZone('America/Mexico_City'));

			$userLog = new UsersLog();
			$userLog->setUser(1);
			$userLog->setActivityDate($activityDate->format('Y-m-d H:i:s'));
			$userLog->setActivity(8);
			$userLog->setDescription($user[0]->getFolio());
			
			$userLogModel = new UsersLogModel();
			$userLogModel->addUsersLog($userLog);

			header('Location: ../../../students/index.php');
			exit;

		}else{
			$_SESSION['message'] = 'El folio no existe';
			//header('Location: ../../../login.php');
			$tokenStudent = hash('sha512', '3Stud1antEs');
			echo('<form name="back" id="back" action="../../../login.php" method="post">');
			echo('<input type="hidden" name="inputValidator" value="'.$tokenStudent.'" />');
			echo('</form>');
	    echo('<script>document.forms.back.submit()</script>');
			exit;
		}
	}

	public function loginAction($userName, $password){

		if(strlen($userName) < 5 || strlen($userName) > 50){
			$_SESSION['message'] = 'El nombre de usuario es de 5 a 50 caracteres.';
			header('Location: ../../../login.php');
			exit;
		}

		$userName = filter_var($userName, FILTER_SANITIZE_STRING);
		$password = filter_var($password, FILTER_SANITIZE_STRING);
		$userByName = $this->getEntityByAction("user_name", $userName);

		if($userByName[0]){
			$user = $this->displayByAction("user_name like :userName and password like :password", array('userName' => $userName, 'password' => $password));
			if($user){
				//ini_set("session.cookie_lifetime","1800");
				//ini_set("session.gc_maxlifetime","1800");
				ini_set("session.cookie_lifetime","36000");

				session_start();

				$_SESSION['name'] = 'c3E3y_Tr4Y3Ct0r14S';
				$_SESSION['user'] = serialize($user['0']);
				$_SESSION['message'] = 'Acceso Correcto';

				$activityDate = new DateTime('', new DateTimeZone('America/Mexico_City'));

				$userLog = new UsersLog();
				$userLog->setUser($user[0]->getId());
				$userLog->setActivityDate($activityDate->format('Y-m-d H:i:s'));
				$userLog->setActivity(1);
				$userLogModel = new UsersLogModel();
				$userLogModel->addUsersLog($userLog);

				$usersLogController = new UsersLogController();
				$where = 'e.user = :user AND e.activity = 1';
				$whereFields = array('user' => $user[0]->getId());
				$totalLogin = count($usersLogController->displayByAction($where, $whereFields));

				if($totalLogin == 1){
					switch($user[0]->getType()){
						case 1:
						case 989:
						header('Location: ../../../mng/changePassword.php');
						break;
						case 2:
						header('Location: ../../../adm/changePassword.php');
						break;
						case 4:
						header('Location: ../../../director/changePassword.php');
						break;
						case 5:
						header('Location: ../../../supervisor/changePassword.php');
						break;
						case 6:
						header('Location: ../../../docente/changePassword.php');
						break;
					}
				}else{
					switch($user[0]->getType()){
						case 1:
						case 989:
						header('Location: ../../../mng/index.php');
						break;
						case 2:
						header('Location: ../../../adm/index.php');
						break;
						case 4:
						header('Location: ../../../director/index.php');
						break;
						case 5:
						header('Location: ../../../supervisor/index.php');
						break;
						case 6:
						header('Location: ../../../docente/index.php');
						break;
					}
				}

				exit;
			}else{
				$_SESSION['message'] = 'El nombre de usuario y/o contrase&ntilde;a son incorrectos';
				header('Location: ../../../login.php');
				exit;
			}

		}else{
			$_SESSION['message'] = 'El nombre de usuario y/o contrase&ntilde;a son incorrectos';
			header('Location: ../../../login.php');
			exit;
		}

	}

	public function logOutAction($idUser){

		$activityDate = new DateTime('', new DateTimeZone('America/Mexico_City'));

		$userLog = new UsersLog();
		$userLog->setUser($idUser);
		$userLog->setActivityDate($activityDate->format('Y-m-d H:i:s'));
		$userLog->setActivity(2);
		$userLogModel = new UsersLogModel();
		$userLogModel->addUsersLog($userLog);

		session_unset();
		session_destroy();
		header('Location: ../../../login.php');
	}

	function RandomToken($length = 32){
		if(!isset($length) || intval($length) <= 8 ){
			$length = 32;
		}
		if (function_exists('random_bytes')) {
			return bin2hex(random_bytes($length));
		}
		if (function_exists('mcrypt_create_iv')) {
			return bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
		}
		if (function_exists('openssl_random_pseudo_bytes')) {
			return bin2hex(openssl_random_pseudo_bytes($length));
		}
	}

	function Salt(){
		return substr(strtr(base64_encode(hex2bin($this->RandomToken(32))), '+', '.'), 0, 44);
	}

	public function sendEmail($to, $fromUser, $subject, $message){

		$headers   = array();
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-type: text/plain; charset=iso-8859-1";
		$headers[] = "From: {$fromUser}";
		$headers[] = "Cc: William Eliezer Pacheco Ceballos <william.pacheco@yucatan.gob.mx>";
		$headers[] = "Subject: {$subject}";

		print_r($message);
		exit;
		mail($to, $subject, $message, implode("\r\n", $headers));

	}

	public function recoverPaswordAction(){
		extract($_POST);
		if(isset($email)){

			$object= $this-> getEntityByAction('email', $email);
		}else{
			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
		if(is_null($object)){

			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
		try{
			$user = $object[0];
			$fromUser = 'CEEEY <ceeey.online@gmail.com>';
			$subject = 'Recuperaci&oacute;n de Contrase&ntilde;a';
			$message = '<html>
			<head>
			<title>Recuperar Contrase&ntilde;a</title>
			</head>
			<body>
			<p>' . $this->RandomToken() .'</p>
			</body>
			</html>';
			$this->sendEmail($user, $fromUser, $subject, $message);
		}catch(Exception $e){
			$_SESSION['flash'] = $e->getMessage();
			echo('<script>javascript:history.go(-1)</script>');
			exit;
		}
	}

	public function createAction()
	{
		extract($_POST);
		try {

			if($userType == 2){
				if(!preg_match("/^[a-zA-Z0-9]+(\.*[a-zA-Z0-9]*)*[a-zA-Z0-9]+$/", $userName)){
					throw new Exception('El nombre de usuario solo puede contener letras, numeros y puntos');
				}
			}elseif($userType == 4){
				$userName = $cct;
			}elseif($userType == 5){

				$schoolRegionZoneController = new SchoolRegionZoneController();
				$schoolZoneObject = $schoolRegionZoneController->getEntityAction($schoolZone);

				if($schoolMode == 4){
					$userName = 'PrimariaGeneralZona'.$schoolZoneObject->getZone();
				}elseif($schoolMode == 5){
					$userName = 'PrimariaIndigenaZona'.$schoolZoneObject->getZone();
				}
			}elseif($userType == 6){
				$userName = $cct.$schoolGrade.$schoolGroup;
			}

			$userExist = $this->getEntityByAction('user_name', $userName);
			if(!empty($userExist)){
				throw new Exception('El nombre de usuario ya existe');
			}

			$schoolController = new SchoolController();
			$school = $schoolController->getEntityByAction('cct', $cct);

			$object= new Users();
			$object->setType($userType);
			$userTypeController = new UserTypeController();
			$userTypeObject = $userTypeController->getEntityAction($userType);
			$object->setUserName($userName);
			$object->setName($name);
			$object->setLastName($lastName);
			$object->setSecondName($secondName);
			$object->setEmail($email);
			$object->setGender($gender);
			if(!$school){
				$object->setSchool(3554);
			}else{
				$object->setSchool($school[0]->getId());
			}
			$object->setSchoolLevel($schoolLevel);
			$object->setPassword(hash('sha512', $password));
			$object->setTitle($title);
			$object->setAbbreviation($userTypeObject->getAbbreviation());
			$this -> model -> addUsers($object);


			$_SESSION['flash'] = 'Usuario Agregado';

		} catch (Exception $e) {
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

			$userEmail = $this->getEntityByAction('email', $email);

			if(($userEmail[0] == $email) && ($userEmail[0]->getId() != $object->getemail())){
				throw new Exception('El correo electr&oacute;nico ya se encuentra en uso');
			}

			//$object->setUserName($userName);
			$object->setName($name);
			$object->setLastName($lastName);
			$object->setSecondName($secondName);
			$object->setEmail($email);
			$object->setGender($gender);
			//$object->setSchool($school);
			$object->setSchoolLevel($schoolLevel);
			$object->setTitle($title);
			//$object->setPassword($password);
			$this -> model -> updateUsers($object);

			$activityDate = new DateTime('', new DateTimeZone('America/Mexico_City'));

			$userLog = new UsersLog();
			$userLog->setUser($object->getId());
			$userLog->setActivityDate($activityDate->format('Y-m-d H:i:s'));
			$userLog->setActivity(5);
			$userLogModel = new UsersLogModel();
			$userLogModel->addUsersLog($userLog);

			$_SESSION['flash'] = 'Actualizac&oacute;n Correcta';
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

				$this -> model -> deleteUsers($object);
			}
		}else{
			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
	}

	public function changePasswordAction(){

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

			if($object->getPassword() != hash('sha512', $oldPassword)){
				throw new Exception('La contrase&ntilde;a anterior no coincide');
			}

			$object->setName(html_entity_decode($object->getName()));
			$object->setName(html_entity_decode($object->getName()));
			$object->setLastName(html_entity_decode($object->getLastName()));
			$object->setSecondName(html_entity_decode($object->getSecondName()));
			$object->setTitle(html_entity_decode($object->getTitle()));
			$object->setPassword(hash('sha512', $newPassword));
			$this -> model -> updateUsers($object);

			$activityDate = new DateTime('', new DateTimeZone('America/Mexico_City'));
			$keyEncrypt1 = $this->encrypt_decrypt('encrypt', $newPassword);
			$userLog = new UsersLog();
			$userLog->setUser($object->getId());
			$userLog->setActivityDate($activityDate->format('Y-m-d H:i:s'));
			$userLog->setActivity(6);
			$userLog->setDescription($keyEncrypt1);
			$userLogModel = new UsersLogModel();
			$userLogModel->addUsersLog($userLog);

			$_SESSION['flash'] = 'Contrase&ntilde;a Actualizada';
		}catch(Exception $e){
			$_SESSION['flash'] = $e->getMessage();
			echo('<script>javascript:history.back(-1); return false;</script>');
		}
	}

	public function changePasswordAdminAction(){

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

			$object->setName(html_entity_decode($object->getName()));
			$object->setName(html_entity_decode($object->getName()));
			$object->setLastName(html_entity_decode($object->getLastName()));
			$object->setSecondName(html_entity_decode($object->getSecondName()));
			$object->setTitle(html_entity_decode($object->getTitle()));
			$object->setPassword(hash('sha512', $newPassword));
			$this -> model -> updateUsers($object);

			$activityDate = new DateTime('', new DateTimeZone('America/Mexico_City'));
			$keyEncrypt1 = $this->encrypt_decrypt('encrypt', $newPassword);
			$userLog = new UsersLog();
			$userLog->setUser($object->getId());
			$userLog->setActivityDate($activityDate->format('Y-m-d H:i:s'));
			$userLog->setActivity(6);
			$userLog->setDescription($keyEncrypt1);
			$userLogModel = new UsersLogModel();
			$userLogModel->addUsersLog($userLog);

			$_SESSION['flash'] = 'Contrase&ntilde;a Actualizada';
		}catch(Exception $e){
			$_SESSION['flash'] = $e->getMessage();
			echo('<script>javascript:history.back(-1); return false;</script>');
		}
	}

	public function generateRandomString($length) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
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

	public function listAction()
	{
		$fields = array('e.last_name', 'e.second_name', 'e.name', 'e.email', 'e.user_name', 'user_type.name', 'CONCAT_WS(" ", e.last_name, e.second_name, e.name)',
		'CONCAT_WS(" ", e.name, e.last_name, e.second_name)');
		$where = '';
		$whereFields = '';
		$join = 'INNER JOIN user_type ON e.type = user_type.id';
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
			foreach ($result as $data) {
				$row = array();
				$row[] = $data -> getId();
				$row[] = $data -> getLastName();
				$row[] = $data -> getSecondName();
				$row[] = $data -> getName();
				$row[] = $data -> getEmail();
				$row[] = $data -> getUserName();
				$row[] = $data -> getUserTypeObject() -> getName();
				$output['aaData'][] = $row;
			}
		}
		echo(json_encode($output));
	}
}
?>

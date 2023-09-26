<?php
require_once ('../lib/genius/Core/gosConfig.inc.php');
include_once ('../imports/php/Autoloader.class.php');
Autoloader::setup();

if (!isset($_SESSION)) {
	
	session_name();
	session_start();
}

if (!isset($_POST['action'])) {
		echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
		echo('<script>document.forms.valid.submit()</script>');
		exit;
}else{
		$controller = new NewsController();
}

switch($_POST['action']){
	case 'add':
		$controller->createAction();
		break;
	case 'edit':
		$controller->updateAction();
		break;
	case 'delete':
		$controller->deleteAction();
		break;
	
}

echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
echo('<script>document.forms.valid.submit()</script>');
exit;

?>